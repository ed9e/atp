<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;

use App\Service\Atp\ATP;
use DateInterval;
use DateTime;
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
    public function current()
    {
        $atp = new ATP();
        $atp->plan([
            'from' => '2020-08-09',
            'to' => '2021-07-04'
        ])->fetchData()->rework();


        return $this->render('atp/index.html.twig', $atp->getAtp());
    }
}
