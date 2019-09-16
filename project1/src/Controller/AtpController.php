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

        $from = (new DateTime())->setTimestamp(strtotime('next monday'));
        $to = (new DateTime())->setTimestamp(strtotime('next monday'))->add(new DateInterval('P36W'));
        $form = $this->createFormBuilder()
            ->add('planName', TextType::class)
            ->add('fromDate', DateType::class, ['block_prefix' => 'wrapped_text', 'widget' => 'single_text', 'data' => $from])
            ->add('dueDate', DateType::class, ['block_prefix' => 'wrapped_text', 'widget' => 'single_text', 'data' => $to])
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $atp->plan([
            'from' => '2019-06-03',
            'to' => '2019-10-14',
            //'to' => '2020-10-26',
        ])->fetchPlan()->rework();

        return $this->render('atp/index.html.twig', array_merge($atp->getAtp(), ['form' => $form->createView()]));
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

        $weekly = $em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->findByOwnerFullName('Łukasz Brzozowski');
        $weeklyData = array_column($weeklyResult, 'timeMinuteSum', 'weekly');
        $diff = array_diff($keys, array_keys($weeklyData));
        $done = array_merge(array_fill_keys($diff, 1), $weeklyData);
        ksort($done);

        $values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous monday')), 'P20W'), 5);
        $template = ['keys' => $keys, 'done' => $done, 'values' => $values];
        return $this->render('atp/current.html.twig', $template);
    }
}
