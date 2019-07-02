<?php

namespace App\Command\Garmin\Activities;

use App\Command\AbstractCommand;
use App\Command\Garmin\Traits\EntityManipulate;
use App\Entity\GarminActivityDetails;
use App\Garmin\Stock\Request\Activities as ActivitiesRequest;
use App\Garmin\Stock\Request\Activities;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivityDetailsManager;
use Symfony\Bundle\MakerBundle\Util\ClassSourceManipulator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FetchActivitiesCommand extends AbstractCommand
{
    use EntityManipulate;

    protected static $defaultName = 'garmin:activities';
    protected $title = 'Get garmin activities';

    protected $params;

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
            ->setDescription('Getting garmin activities.')
            ->setHelp('')
            ->addArgument('action', InputArgument::REQUIRED, 'Action: response, map, fields, entity')
        ;
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action'))
        {
            case 'entity':
                $className = explode('\\', GarminActivityDetails::class);
                $this->entityManipulate(end($className));
                break;
            default:
            case 'response':
                $this->info(var_export(($this->getActivityResponse()), true));
                break;

        }
    }


    protected function getActivityResponse()
    {
        $garmin = new ActivitiesRequest();
        return $garmin->fetch()->toArray();
    }
}