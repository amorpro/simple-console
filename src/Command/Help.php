<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 28.01.2019
 * Time: 16:15
 */

namespace App\Command;


use App\Contract\Command;

class Help extends Command
{

    public function execute()
    {
        echo 'Available commands:' . PHP_EOL;
        foreach ($this->console->commandsWhitelist as $key => $value) {
            echo 'cli ' . $key . PHP_EOL;
        }
    }
}