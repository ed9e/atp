<?php

namespace App\Command\Garmin;

use App\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;

class ImportCommand extends AbstractCommand
{
    protected static $defaultName = 'garmin:import';
    protected $title = 'Garmin import';
    protected $requireParam;

    public function __construct(bool $requireParam = false)
    {
        $this->requireParam = $requireParam;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
            ->addArgument('parameter', $this->requireParam ? InputArgument::REQUIRED : InputArgument::OPTIONAL, 'Require parameter');
    }

    protected function handle()
    {
        // TODO: Implement handle() method.
    }
}