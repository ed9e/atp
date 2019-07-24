<?php


namespace App\Command\Traits;

use Symfony\Component\Console\Input\InputArgument;


trait ActionMap
{
    protected $actionMap = [];
    protected $argumentName = 'action';

    protected function handle(): void
    {
        $action = $this->input->getArgument($this->argumentName);

        if (!$action) {
            $this->info($this->actionMap);
        } else {
            if (array_key_exists($action, $this->actionMap)) {
                /** @var ActionMapElement $actionMapElement */
                $actionMapElement = $this->actionMap[$action];
                $function = $actionMapElement->getFunctionName();
                $this->info($actionMapElement->getInfo());
                $this->$function($this->input->getArguments(), $this->input->getOptions());
            }
        }
    }

    protected function configure()
    {
        $this
            ->addArgument($this->argumentName, InputArgument::OPTIONAL, 'Action:');
        $this->_configure();
    }
}