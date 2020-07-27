<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    use Helper\DecorateCommand;

    /** @var InputInterface */
    protected $input;
    /** @var  OutputInterface */
    protected $output;

    protected $printHeader = true;
    protected $title;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;
        !$this->printHeader ?: $this->header();
        $this->handle();
        return 0;
    }

    protected abstract function handle(): void;

    protected function header()
    {
        $this->info([
            '',
            $this->getTitle(),
            str_pad('', strlen($this->getTitle()), '#'),
            '',
        ]);
    }

    protected function getTitle()
    {
        return $this->title ?: get_class();
    }

    /**
     * @param string|iterable $message
     * @param int $opt
     */
    protected function line($message, $opt = 0)
    {
        $this->output->writeln($message, $opt);
    }

    protected function error($message, $opt = 0)
    {
        $this->decorate($message, 'error');
        $this->output->writeln($message, $opt);
    }

    protected function info($message, $opt = 0)
    {
        $this->decorate($message, 'info');
        $this->output->writeln($message, $opt);
    }

    protected function option($option)
    {
        return $this->input->getArgument($option);
    }


}