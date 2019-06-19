<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\ActivityDetails;
use App\Garmin\Stock\Calendar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ActivityCommand extends AbstractCommand
{
    protected $title = 'Get garmin activity details';
    protected static $defaultName = 'garmin:activity';
    protected $activity_id;

    private $paramStringActivityId = 'id';

    protected function configure()
    {
        $this
            ->setDescription('Getting garmin activity details.')
            ->setHelp('')
            ->addArgument($this->paramStringActivityId, InputArgument::REQUIRED, 'Activity ID is required!');
    }

    protected function handle()
    {
        $this->activity_id = $this->input->getArgument($this->paramStringActivityId);
        $garmin = new ActivityDetails();
        $garmin->setActivityId($this->activity_id);
        $this->info($garmin->fetch());
    }
}