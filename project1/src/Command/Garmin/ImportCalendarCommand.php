<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Service\GarminManager;
use Symfony\Component\Console\Input\InputArgument;

class ImportCalendarCommand extends AbstractCommand
{
    protected static $defaultName = 'garmin:calendar:import';
    protected $title = 'Import garmin calendar';
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
            ->addArgument('month', InputArgument::REQUIRED, 'Calendar month required')
            ->addArgument('year', InputArgument::REQUIRED, 'Calendar month required')
            ;
    }

    protected function handle(): void
    {
        $this->garminManager->getGarminCalendar()->setMonth(
            $this->input->getArgument('month')
        );
        $this->garminManager->getGarminCalendar()->setYear(
            $this->input->getArgument('year')
        );
        $this->garminManager->importCalendar();

        $this->info('ok');
    }
}