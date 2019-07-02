<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Command\Garmin\Traits\EntityManipulate;
use App\Entity\GarminActivityDetails;
use App\Garmin\Stock\Request\ActivityDetails as ActivityDetailsRequest;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivityDetailsManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ActivityCommand extends AbstractCommand
{
    use EntityManipulate;

    protected static $defaultName = 'garmin:activity';
    protected $title = 'Get garmin activity details';
    protected $activity_id;
    protected $params;

    private $paramStringActivityId = 'id';
    private $garminManager;

    public function __construct(GarminActivityDetailsManager $garminManager, ParameterBagInterface $params)
    {
        $this->params = $params;
        $this->garminManager = $garminManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Getting garmin activity details.')
            ->setHelp('')
            ->addArgument('action', InputArgument::REQUIRED, 'Action: response, map, fields, entity')
            ->addArgument($this->paramStringActivityId, InputArgument::OPTIONAL, 'Activity ID is required!');
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action')) {
            case 'entity':
                $this->entityManipulate(GarminActivityDetails::class);
                break;
            case 'map':
                dump($this->getActivityMap());
                break;
            case 'fields':
                dump($this->getActivityEntityFields());
                break;
            default:
            case 'response':
                dump($this->getActivityResponse());
                break;

        }
    }

    protected function getActivityMap()
    {
        return $this->garminManager->getMap();
    }

    protected function getActivityEntityFields()
    {
        $ret = [];
        foreach ($this->garminManager->getMap() as $fieldMap) {
            /**@var EntityFieldMap $fieldMap */
            $ret[$fieldMap->getEfi()->getName()] = $fieldMap->getEfi()->getType();
        }
        return $ret;
    }

    protected function getActivityResponse()
    {
        $this->activity_id = $this->input->getArgument($this->paramStringActivityId);
        $garmin = new ActivityDetailsRequest();
        $garmin->setActivityId($this->activity_id);
        return $garmin->fetch()->getContent();
    }
}