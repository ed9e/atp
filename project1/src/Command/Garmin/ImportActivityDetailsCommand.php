<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Calendar;
use App\Service\GarminActivityDetailsManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ImportActivityDetailsCommand extends AbstractCommand
{
    protected $title = 'Import garmin activity details';
    protected static $defaultName = 'garmin:activity:import';

    private $garminManager;

    public function __construct(GarminActivityDetailsManager $garminManager)
    {
        $this->garminManager = $garminManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Imports garmin activity details.')
            ->setHelp('')
        ;
    }

    protected function handle()
    {
        $this->garminManager->import();

        $this->info('ok');
    }
}