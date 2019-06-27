<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Request\Calendar;
use App\Service\GarminActivityDetailsManager;
use Symfony\Component\Console\Input\InputArgument;

class CalendarCommand extends AbstractCommand
{
    protected static $defaultName = 'garmin:calendar';
    protected $title = 'Get garmin calendar';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('')
            ->addArgument('action', InputArgument::OPTIONAL, 'Action: response, ')
        ;
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action')) {
            default:
            case 'response':
                $garminCalendar = new Calendar();
                $this->info(print_r($garminCalendar->fetch()->toArray(), true));
                break;
        }
    }
}