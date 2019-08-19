<?php

namespace App\Command\Garmin\Activities;

use App\Command\AbstractCommand;
use App\Command\Garmin\Traits\EntityManipulate;
use App\Entity\GarminActivityDetails;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivitiesManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
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
            ->addArgument('user', InputArgument::OPTIONAL, 'User display name')
            ->addOption('start', 's', InputOption::VALUE_OPTIONAL)
            ->addOption('full', 'f', InputOption::VALUE_OPTIONAL)
            ->addOption('run', 'r', InputOption::VALUE_OPTIONAL);
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action')) {
            case 'import':
                if (null !== $this->input->getArgument('user')) {
                    $this->garminManager->setUserDisplayName($this->input->getArgument('user'));
                }

                $this->garminManager->getRequest()->setStart($this->input->getOption('start'));
                if ($this->input->getOption('run') === '1') {
                    $this->garminManager->run();
                } else {
                    if ($this->input->getOption('full')) {
                        for ($i = 0; $i <= 16; $i++) {
                            $this->garminManager->clearRequest()->getRequest()->setStart($i * 100);
                            $this->garminManager->import();
                        }
                    } else
                        $this->garminManager->import();
                }
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