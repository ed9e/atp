<?php


namespace App\Controller;

use App\Entity\GarminActivityDetails;
use App\Repository\ActivityDetailsRepository;
use App\Service\GroupedData;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/")
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        /** @var ActivityDetailsRepository $repository */
        $repository = $this->entityManager->getRepository(GarminActivityDetails::class);
        $data = $repository->findByStartTime($this->prepareQueryRequest($request));
        return $this->json(['data' => $data]);
    }

    protected function prepareQueryRequest($request): array
    {
        $date = $request->query->get('data');
        $data = DateTime::createFromFormat('Y-m-d', $date);
        $data = $data !== false ? $data->format('Y-m-d') : date('Y-m-d', strtotime('-2 Monday'));
        $activityId = explode(',', $request->query->get('activityId'));
        $userDisplayName = $request->query->get('profileId');
        return [
            'data' => $data,
            'activityId' => $activityId,
            'userDisplayName' => $userDisplayName
        ];
    }

    /**
     * @Route("/weekly")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function weekly(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $weekly = new GroupedData($request, $em);
        $data = $weekly->getWeekly();
        return $this->json(['data' => $data]);
    }


    /**
     * @Route("/atp")
     * @param Request $request
     * @return JsonResponse
     */
    public function atp(Request $request, ATP $atp)
    {
        $from = (new DateTime())->setTimestamp(strtotime('next friday'));
        $to = (new DateTime())->setTimestamp(strtotime('next friday'))->add(new DateInterval('P36W'));
        $form = $this->createFormBuilder()
            ->add('planName', TextType::class)
            ->add('fromDate', DateType::class, ['block_prefix' => 'wrapped_text', 'widget' => 'single_text', 'data' => $from])
            ->add('dueDate', DateType::class, ['block_prefix' => 'wrapped_text', 'widget' => 'single_text', 'data' => $to])
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $atp->plan([
            'from' => '2019-11-14',
            'to' => '2020-09-01',
        ])->fetchPlan()->rework();
        $atpPlan1 = $atp->getAtp();

        $atp->plan([
            'from' => '2020-09-01',
            'to' => '2021-02-01',
        ])->fetchPlan()->rework();
        $atpPlan2 = $atp->getAtp();


        $keys = array_merge($atpPlan1['keys'], $atpPlan2['keys']);
        $done = array_merge($atpPlan1['done'], $atpPlan2['done']);
        $values = array_merge($atpPlan1['values'], $atpPlan2['values']);
        $phases2 = array_merge_recursive($atpPlan1['phases2'], $atpPlan2['phases2']);
        $phases = array_merge_recursive($atpPlan1['phases'], $atpPlan2['phases']);
        $diff = array_diff($keys, array_keys($values));

        $values = array_merge(array_fill_keys($diff, 0), $values);
        ksort($values);

        $atpPlan = [
            'keys' => $keys,
            'done' => $done,
            'values' => $values,
            'phases' => $phases,
            'phases2' => $phases2
        ];

        $zawody = [
            '2017-03-11' => '12h w Kopalni Soli',
            '2019-01-26' => 'ZMB 2019',
            '2018-01-28' => 'ZMB 2018',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',

        ];
        $atpPlan['flags'] = $zawody;
        return $this->json(['data' => $atpPlan]);
    }

}