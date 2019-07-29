<?php

namespace App\Command\Atp;

use App\Command\AbstractCommand;
use App\Command\Traits\ActionMap;
use App\Command\Traits\ActionMapElement;
use App\Config\Service;
use App\Service\Atp\Calendar;
use App\Service\Atp\Component;
use App\Service\Atp\ExoPhase\PhaseIterator;
use App\Service\Atp\MesoPhase\MesoPhaseAbstract;
use App\Service\Atp\PlanIterator;
use Symfony\Component\Console\Input\InputOption;

class AtpCommand extends AbstractCommand
{
    use ActionMap;
    protected static $defaultName = 'atp:config';
    protected $title = 'Atp config';

    protected $service;
    use ActionMap;

    public function __construct(Service $service, $name = null)
    {
        $this->service = $service;
        parent::__construct($name);
        $this->actionMap = [
            'createatp' => (new ActionMapElement('createAtp'))->setInfo('Create atp'),
        ];
    }

    protected function _configure(): void
    {
        $this
            ->setDescription('Reads/Writes config.')
            ->setHelp('...')
            ->addOption('from', 'f', InputOption::VALUE_OPTIONAL, 'Date from')
            ->addOption('to', 't', InputOption::VALUE_OPTIONAL, 'Date to')
            ->addOption('avgH', null, InputOption::VALUE_OPTIONAL, 'Average hours');
    }


    protected function createAtp($args, $options)
    {
        $start = new \DateTime($options['from']);
        $end = new \DateTime($options['to']);

        $interval = new \DateInterval('P7D');
        $period = new \DatePeriod($start, $interval, $end);

        //dump(iterator_count($period));
        $dateArray = [];
        foreach ($period as $date) {
            $dateArray[] = $date->format('Y-m-d');
        }
        $reversedDates = array_reverse($dateArray);
        $calendar = new Calendar($reversedDates);
        /** Składowe jakie będą brały udział w tworzeniu planu */
        $phasesComponent = new Component($calendar);
        /** Liczba iteracji do stworzenia planu */
        $planIterator = new PlanIterator(7);

        $phasesIterator = new PhaseIterator($phasesComponent->getPhases());

        foreach ($planIterator as $iterationNo => $iteration) {

            foreach ($phasesIterator as $phase) {
                try {
                    /** Zabieranie wolnych mikrofaz */
                    $phase->getPlaceTaker()->takePlace($iterationNo);
                } catch (\Exception $e) {

                }
            }
        }


        // dump($calendar->getCountWeeks());
        //$phasesComponent->showTaken();

        foreach ($phasesIterator as $phase) {

            dump(get_class($phase));
            dump($phase->getMesoPhases()->count());
            foreach ($phase->getMesoPhases() as $mesoPhase) {

                /** @var MesoPhaseAbstract $mesoPhase */
                foreach ($mesoPhase->getMicroPhases() as $val) {
                    // dump($val);
                    $calendar->setExoPhase($val, get_class($mesoPhase) . ' ' . $mesoPhase->getNumber());
                }
            }
        }
        dump($calendar->getCalendar());

    }

}