<?php

namespace Logger\Handlers;

use Logger\LogLevel;

abstract class BaseHandler 
{
    protected $isEnabled = true;
    protected $levels = [];

    public function __construct(array $params)
    {
        $this->isEnabled = $params['is_enabled'] ?? $this->isEnabled;
        $this->levels = $params['levels'] ?? $this->levels;
    }

    abstract public function log(string $level, string $message): void;

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

    public function setIsEnabled(bool $value): void
    {
        $this->isEnabled = $value;
    }

    protected function checkLogLevel(string $level): bool
    {
        if (!$this->levels || in_array($level, $this->levels)) {
            return true;
        }

        return false;
    }
}