<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Request\ActivityDetails as ActivityDetailsRequest;
use Symfony\Component\Console\Input\InputArgument;

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
        $garmin = new ActivityDetailsRequest();
        $garmin->setActivityId($this->activity_id);
        $this->info($garmin->fetch());
    }
}