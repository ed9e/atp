<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends AbstractCommand
{
    protected $title = 'Testing 1...2...3...';
    protected static $defaultName = 'app:TestCommand';
    protected $requireParam;

    public function __construct(bool $requireParam = false)
    {
        $this->requireParam = $requireParam;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('parameter', $this->requireParam ? InputArgument::REQUIRED : InputArgument::OPTIONAL, 'Require parameter');
    }

    protected function handle()
    {
        $this->error($this->input->getArguments(), OutputInterface::VERBOSITY_VERBOSE);
    }
}