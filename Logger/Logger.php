<?php

namespace Logger;

use Logger\Handlers\BaseHandler;
use Logger\LogLevel;

class Logger 
{
    protected $handlers = [];

    public function addHandler(BaseHandler $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function log(string $level, string $message): void
    {
        foreach ($this->handlers as $item) {
            $item->log($level, $message);
        }
    }

    public function error(string $message): void
    {
        $this->log(LogLevel::ERROR, $message);
    }

    public function info(string $message): void
    {
        $this->log(LogLevel::INFO, $message);
    }

    public function debug(string $message): void
    {
        $this->log(LogLevel::DEBUG, $message);
    }

    public function notice(string $message): void
    {
        $this->log(LogLevel::NOTICE, $message);
    }
}