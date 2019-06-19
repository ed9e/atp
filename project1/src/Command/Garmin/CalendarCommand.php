<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Calendar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class CalendarCommand extends AbstractCommand
{
    protected $title = 'Get garmin calendar';
    protected static $defaultName = 'garmin:calendar';
    protected $session_id;
    private $paramSessionId = 'sess_id';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('')
            //->addArgument($this->paramSessionId, InputArgument::REQUIRED, 'Session ID is required!')
        ;
    }

    protected function handle()
    {
        //$this->session_id = $this->input->getArgument($this->paramSessionId);
        $garminCalendar = new Calendar();
        $this->info($garminCalendar->fetch());
    }
}