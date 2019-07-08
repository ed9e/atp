<?php

namespace App\Command\Garmin\Activities;

use App\Command\AbstractCommand;
use App\Command\Garmin\Traits\EntityManipulate;
use App\Entity\GarminActivityDetails;
use App\Garmin\Stock\Request\Activities;
use App\Garmin\Stock\Request\Activities as ActivitiesRequest;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivitiesManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FetchActivitiesCommand extends AbstractCommand
{
    use EntityManipulate;

    protected static $defaultName = 'garmin:activities';
    protected $title = 'Dej treninga';

    protected $params;

    private $garminManager;

    public function __construct(GarminActivitiesManager $garminManager, ParameterBagInterface $params)
    {
        $this->params = $params;
        $this->garminManager = $garminManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Getting garmin activities.')
            ->setHelp('')
            ->addArgument('action', InputArgument::REQUIRED, 'Action: response, map, fields, entity')
            ->addArgument('user', InputArgument::OPTIONAL, 'User display name');
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action')) {
            case 'import':
                if (null !== $this->input->getArgument('user'))
                    $this->garminManager->setUserDisplayName($this->input->getArgument('user'));
                $this->garminManager->import();
                $this->info('ok');
                break;
            case 'entity':
                $className = explode('\\', GarminActivityDetails::class);
                $this->entityManipulate(end($className));
                break;
            case 'fields':
                dump($this->getActivityEntityFields());
                break;
            case 'map':
                dump($this->getActivityMap());
                break;
            default:
            case 'response':
                $this->info(var_export(($this->getActivityResponse()), true));
                break;

        }
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

    protected function getActivityMap()
    {
        return $this->garminManager->getMap();
    }

    protected function getActivityResponse()
    {
        return $this->garminManager->getRequest()->fetch()->toArray();
    }
}