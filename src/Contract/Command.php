<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 28.01.2019
 * Time: 16:15
 */

namespace App\Contract;

use App\Console;

abstract class Command
{
    protected $console;

    public function setConsole(Console $console)
    {
        $this->console = $console;
    }

    abstract public function execute();

    public function writeLn($message)
    {
        return $this->write($message . "\n");
    }

    public function write($message)
    {
        echo $message;
        return $this;
    }
}