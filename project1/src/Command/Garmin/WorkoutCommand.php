<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Request\Workout as WorkoutRequest;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivityDetailsManager;
use Symfony\Bundle\MakerBundle\Util\ClassSourceManipulator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WorkoutCommand extends AbstractCommand
{
    protected static $defaultName = 'garmin:workout';
    protected $title = 'Get garmin workout details';
    protected $id;
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
            ->setDescription('Getting garmin workout details.')
            ->setHelp('')
            ->addArgument('action', InputArgument::REQUIRED, 'Action: response, map, fields, entity')
            ->addArgument($this->paramStringActivityId, InputArgument::OPTIONAL, 'ID is required!')
        ;
    }

    protected function handle(): void
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
                $this->info(var_export($this->getActivityResponse(), true));

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
        $this->id = $this->input->getArgument($this->paramStringActivityId);
        $garmin = new WorkoutRequest();
        $garmin->setWorkoutId($this->id);
        return json_decode($garmin->fetch()->getContent(), true, JSON_PRETTY_PRINT);
    }
}