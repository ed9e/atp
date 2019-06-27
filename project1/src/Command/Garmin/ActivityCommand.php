<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Request\ActivityDetails as ActivityDetailsRequest;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivityDetailsManager;
use Symfony\Bundle\MakerBundle\Util\ClassSourceManipulator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ActivityCommand extends AbstractCommand
{
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
            ->addArgument($this->paramStringActivityId, InputArgument::OPTIONAL, 'Activity ID is required!')
        ;
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action'))
        {
            case 'entity':
                $this->changeEntity();
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

    protected function changeEntity()
    {
        $path = $this->params->get('kernel.root_dir') . '/Entity/GarminActivityDetails.php';
        $src = file_get_contents($path);
        $manipulator = new ClassSourceManipulator($src, true);
        foreach ($this->garminManager->getMap() as $fieldMap) {
            /**@var EntityFieldMap $fieldMap */
            $ret[$fieldMap->getEfi()->getName()] = $fieldMap->getEfi()->getType();
            $manipulator->addEntityField($fieldMap->getEfi()->getName(), ['type'=>$fieldMap->getEfi()->getType(), 'nullable'=>$fieldMap->getEfi()->getNullable()], $fieldMap->getEfi()->getDescription());
        }

        file_put_contents($path, $manipulator->getSourceCode());
        $this->info('Fields added');
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