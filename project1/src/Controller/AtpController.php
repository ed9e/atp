<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;

use App\Service\Atp\ATP;
use App\Service\Atp\ATPFetch;
use App\Service\AtpFetchService;
use App\Service\AtpPlanService;
use DateInterval;
use DateTime;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/atp")
 */
class AtpController extends AbstractController
{
    /**
     * @Route("/")
     * @param RequestStack $request
     * @param ATP $atp
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_USER")
     */
    public function index(RequestStack $request, ATP $atp): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $from = (new DateTime())->setTimestamp(strtotime('next friday'));
        $to = (new DateTime())->setTimestamp(strtotime('next friday'))->add(new DateInterval('P36W'));
        $form = $this->createFormBuilder()
            ->add('planName', TextType::class)
            ->add('fromDate', DateType::class, ['block_prefix' => 'wrapped_text', 'widget' => 'single_text', 'data' => $from])
            ->add('dueDate', DateType::class, ['block_prefix' => 'wrapped_text', 'widget' => 'single_text', 'data' => $to])
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $service = new AtpPlanService($request, $atp);
        $plan = $service->getWeekly();

        return $this->render('atp/index.html.twig', array_merge($plan, ['form' => $form->createView()]));
    }

    /**
     * @Route("/fetch")
     * @param RequestStack $request
     * @param ATPFetch $atp
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_USER")
     */
    public function fetch(RequestStack $request, ATPFetch $atp): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $service = new AtpFetchService($request, $atp);
        $plan = $service->getWeekly();

        return $this->render('atp/fetch.html.twig', array_merge($plan, ['form' => '']));
    }

}
