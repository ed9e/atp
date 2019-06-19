<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Calendar;
use App\Service\GarminManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCalendarCommand extends AbstractCommand
{
    protected $title = 'Import garmin calendar';
    protected static $defaultName = 'garmin:calendar:import';

    private $garminManager;

    public function __construct(GarminManager $garminManager)
    {
        $this->garminManager = $garminManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Imports garmin calendar elements.')
            ->setHelp('')
        ;
    }

    protected function handle()
    {
        $this->garminManager->importCalendar();

        $this->info('ok');
    }
}