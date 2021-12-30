<?php

namespace Logger;

class LogLevel 
{
    const ERROR = 'ERROR';
    const INFO = 'INFO';
    const DEBUG = 'DEBUG';
    const NOTICE = 'NOTICE';

    public static function getAllCodes(): array
    {
        return [self::ERROR => '001', self::INFO => '002', self::DEBUG => '003', self::NOTICE => '004'];
    }

    public static function getLevelCode(string $level): string
    {
        $all = self::getAllCodes();
        if (isset($all[$level])) {
            return $all[$level];
        }

        return '';
    }
}