<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;

use App\Entity\WeeklyActivity;
use App\Repository\WeeklyRepository;
use App\Service\Atp\ATP;
use App\Service\Atp\Plan;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     * @Route("/dashboard")
     * @Route("/dashboard/index")
     * @return Response
     * @throws Exception
     */
    public function index(EntityManagerInterface $em)
    {
        $from = 'P80W';
        $to = 'P20W';

        $options = [
            'from' => (new DateTime())->setTimestamp(strtotime('next friday'))->sub(new DateInterval('P120W')),
            'to' => (new DateTime())->setTimestamp(strtotime('next friday')),
        ];
        $plan = new Plan($options);
        $keys = $plan->createIntervalArray($options['from'], clone ($options['to'])->add(new DateInterval('P20W')));

        /** @var WeeklyRepository $weekly */
        $weekly = $em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->getWeekly2(['activityId' => [1,6], 'userDisplayName' => 'lbrzozowski']);
        //$weeklyData = array_column($weeklyResult, 'distanceSum', 'weekly');
        $weeklyData = array_column($weeklyResult, 'timeMinuteSum', 'weekly');
        $diff = array_diff($keys, array_keys($weeklyData));
        $done = array_merge(array_fill_keys($diff, 0), $weeklyData);
        ksort($done);

        $values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous friday')), 'P20W'), 0);
        $zawody = [
            '2019-01-26' => 'Zimowy Maraton',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',

        ];
        $template = ['keys' => $keys, 'done' => $done, 'values' => $values, 'phases' => $zawody];
        return $this->render('dashboard/index.html.twig', $template);
    }

    /**
     * @Route("dashboard/calendar")
     *
     */
    public function calendar(EntityManagerInterface $em)
    {
        $weekly = $em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->getWeekly2(['activityId' => [1,2], 'userDisplayName' => 'lbrzozowski']);
        return new JsonResponse($weeklyResult);
    }

    /**
     * @Route("dashboard/statistics")
     */
    public function statistics()
    {
    }
}
