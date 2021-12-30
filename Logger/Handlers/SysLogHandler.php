<?php

namespace Logger\Handlers;

use Logger\LogLevel;

class SysLogHandler extends BaseHandler 
{
    public function log(string $level, string $message): void
    {
        if (!$this->isEnabled || !$this->checkLogLevel($level)) {
            return;
        }

        $priority = $this->getPriority($level);
        syslog(LOG_WARNING, $message);
    }

    protected function getPriority(string $level): int
    {
        $all = [LogLevel::ERROR => LOG_ERR, LogLevel::INFO => LOG_INFO, LogLevel::DEBUG => LOG_DEBUG, LogLevel::NOTICE => LOG_NOTICE];
        return $all[$level] ?? LOG_ERR;
    }
}