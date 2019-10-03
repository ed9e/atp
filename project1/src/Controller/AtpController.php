<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;

use App\Entity\WeeklyActivity;
use App\Service\Atp\ATP;
use App\Service\Atp\Plan;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/atp")
 */
class AtpController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(ATP $atp)
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


        return $this->render('atp/index.html.twig', array_merge($atpPlan, ['form' => $form->createView()]));
    }

    /**
     * @Route("/current")
     */
    public function current(EntityManagerInterface $em)
    {
        $from = 'P80W';
        $to = 'P20W';

        $options = [
            'from' => (new DateTime())->setTimestamp(strtotime('next monday'))->sub(new DateInterval('P120W')),
            'to' => (new DateTime())->setTimestamp(strtotime('next monday')),
        ];
        $plan = new Plan($options);
        $keys = $plan->createIntervalArray($options['from'], clone ($options['to'])->add(new DateInterval('P20W')));

        $queryData = ['activityId' => [1, 6], 'userDisplayName' => 'lbrzozowski'];

        $weekly = $em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->getWeekly2($queryData);
        $weeklyData = array_column($weeklyResult, 'timeMinuteSum', 'weekly');
        $diff = array_diff($keys, array_keys($weeklyData));
        $done = array_merge(array_fill_keys($diff, 1), $weeklyData);
        ksort($done);

        $values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous monday')), 'P20W'), 5);
        $template = ['keys' => $keys, 'done' => $done, 'values' => $values];
        return $this->render('atp/current.html.twig', $template);
    }
}
