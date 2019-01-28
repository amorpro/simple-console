<?php
namespace App;

use App\Command\Help;
use App\Contract\Command;

class Console
{
    public $commandsWhitelist = [];

    /**
     * Console constructor.
     */
    public function __construct()
    {
        $this->_initCommands();
    }


    public function execute($args)
    {
        if (count($args) > 1) {

            $commandName = array_shift($args);

            if (array_key_exists($commandName, $this->commandsWhitelist)) {
                return $this->executeCommand($this->commandsWhitelist[$commandName], $args);
            }
        }

        $this->outputHelp();
        return false;
    }

    protected function executeCommand($commandClass, $args)
    {
        /** @var Command $command */
        $command = new $commandClass(...$args);
        $command->setConsole($this);
        return $command->execute();
    }

    protected function outputHelp()
    {
        $this->executeCommand(Help::class, []);
    }

    protected function _initCommands()
    {
        foreach (glob(SRC . '\\Command\\*.php') as $file) {
            $file = pathinfo($file, PATHINFO_FILENAME);
            $cmd   = strtolower(preg_replace('/\B([A-Z])/', '_$1', $file));
            $class = sprintf('App\\Command\\%s', $file);

            $this->commandsWhitelist[$cmd] = $class;
        }
    }
}
