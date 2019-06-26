<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Garmin\Stock\Calendar;
use App\Mapper\Type\Response\EntityFieldMap;
use App\Service\GarminActivityDetailsManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportActivityDetailsCommand extends AbstractCommand
{
    protected $title = 'Import garmin activity details';
    protected static $defaultName = 'garmin:activity:import';

    private $garminManager;

    public function __construct(GarminActivityDetailsManager $garminManager)
    {
        $this->garminManager = $garminManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Imports garmin activity details.')
            ->setHelp('')
            ->addArgument('action', InputArgument::OPTIONAL, 'Show keys and path.')
            ->addOption(
                'format',
                'f',
                InputOption::VALUE_OPTIONAL,
                'Dump format',
                'map'
            );
        ;
    }

    protected function handle()
    {
        switch ($this->input->getArgument('action'))
        {
            case 'map-dump':
                dump($this->switchDumpFormat());
                break;
            case 'import':
            default:
                $this->garminManager->import();
                break;
        }

        $this->info('ok');
    }

    protected function switchDumpFormat()
    {
        switch($this->input->getOption('format'))
        {
            default:
            case 'map':
                return $this->garminManager->getMap();
                break;
            case 'compact':
                $ret = [];
                foreach ($this->garminManager->getMap() as $fieldMap) {
                    /**@var EntityFieldMap $fieldMap*/
                    $ret[$fieldMap->getEfi()->getName()] = [
                        'type'=>$fieldMap->getEfi()->getType(),
                        'path'=>$fieldMap->getPath()->getArray()
                    ];
                }
                return $ret;
                break;
        }
    }
}