<?php

namespace App\Command\Atp;

use App\Command\AbstractCommand;
use App\Command\Traits\ActionMap;
use App\Command\Traits\ActionMapElement;
use App\Config\Service;
use App\Service\Atp\Plan;
use Symfony\Component\Console\Input\InputOption;

class AtpCommand extends AbstractCommand
{
    use ActionMap;
    protected static $defaultName = 'atp:config';
    protected $title = 'Atp config';

    protected $service;
    use ActionMap;

    public function __construct(Service $service, $name = null)
    {
        $this->service = $service;
        parent::__construct($name);
        $this->actionMap = [
            'createatp' => (new ActionMapElement('createAtp'))->setInfo('Create atp'),
        ];
    }

    protected function _configure(): void
    {
        $this
            ->setDescription('Reads/Writes config.')
            ->setHelp('...')
            ->addOption('from', 'f', InputOption::VALUE_OPTIONAL, 'Date from')
            ->addOption('to', 't', InputOption::VALUE_OPTIONAL, 'Date to')
            ->addOption('avgH', null, InputOption::VALUE_OPTIONAL, 'Average hours');
    }


    protected function createAtp($args, $options)
    {
        $plan = new Plan();
        $calendar = $plan->create($options);
        dump($calendar->fetch());

    }

}