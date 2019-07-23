<?php

namespace App\Command\Atp;

use App\Command\AbstractCommand;
use App\Command\Traits\ActionMap;
use App\Command\Traits\ActionMapElement;
use App\Config\Service;
use App\Service\Atp\Calendar;
use App\Service\Atp\ExoPhase\Base\Base3;
use App\Service\Atp\ExoPhase\Build\Build1;
use App\Service\Atp\ExoPhase\Peak;
use App\Service\Atp\ExoPhase\PhaseIterator;
use App\Service\Atp\ExoPhase\Race;
use Symfony\Component\Console\Input\InputOption;

class AtpCommand extends AbstractCommand
{
    //use ActionMap;
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

        $interval = new \DateInterval('P1W');
        $period = new \DatePeriod($start, $interval, $end);

        dump(iterator_count($period));
        $dateArray = [];
        foreach ($period as $date) {
            $dateArray[] = $date->format('Y-m-d');
        }
        $reversedDates = array_reverse($dateArray);
        $calendar = new Calendar($reversedDates);
        $atp[] = new Race($calendar);
        $atp[] = new Peak($calendar);
        $atp[] = new Build1($calendar);
        $atp[] = new Base3($calendar);
        $phasesIterator = new PhaseIterator($atp);
        foreach ($phasesIterator as $phase)
        {
            $phase->takePlace();
        }
    }

}