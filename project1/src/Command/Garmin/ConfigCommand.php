<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use App\Config\Service;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ConfigCommand extends AbstractCommand
{
    protected static $defaultName = 'garmin:config';
    protected $title = 'Garmin config';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this

            ->setDescription('Reads/Writes config.')

            ->setHelp('...')
            ->addArgument('action', InputArgument::REQUIRED, 'Action is required')
            ->addOption('value', 'id',  InputOption::VALUE_OPTIONAL, 'Value to set')
        ;
    }

    protected function handle(): void
    {
        switch($this->input->getArgument('action'))
        {
            case 'setSession':
                $session = $this->input->getOption('value');
                $this->service->save($this->service::SESSION_KEY_ID, $session, $this->service::RESOURCE_SESSION_CONFIG);
                break;
            case 'getSession':
                $session = $this->service->load($this->service::RESOURCE_SESSION_CONFIG, $this->service::SESSION_KEY_ID);
                $this->info($session);
                break;
        }
    }
}