<?php

namespace Logger\Formatters;

use DateTime;
use DateTimeZone;
use Logger\LogLevel;

class LineFormatter 
{
    const TIMEZONE = 'Europe/Moscow';

    const PARAM_DATE = '%date%';
    const PARAM_LEVEL_CODE = '%level_code%';
    const PARAM_LEVEL = '%level%';
    const PARAM_MESSAGE = '%message%';

    protected $messageFormat;
    protected $dateFormat;

    public function __construct(string $messageFormat = null, string $dateFormat = null)
    {
        $this->messageFormat = $messageFormat ?? self::PARAM_DATE.' '.self::PARAM_LEVEL_CODE.' '.self::PARAM_LEVEL.' '.self::PARAM_MESSAGE;
        $this->dateFormat = $dateFormat ?? 'Y-m-d H:i:s';
    }

    public function processMessage(string $level, string $message): string
    {
        $search = [];
        $replace = [];

        if (strpos($this->messageFormat, self::PARAM_DATE) !== false) {
            $search[] = self::PARAM_DATE;
            $dateTime = new DateTime;
            $dateTime->setTimezone(new DateTimeZone(self::TIMEZONE));
            $replace[] = $dateTime->format($this->dateFormat);
        }

        if (strpos($this->messageFormat, self::PARAM_MESSAGE) !== false) {
            $search[] = self::PARAM_MESSAGE;
            $replace[] = $message;
        }

        if (strpos($this->messageFormat, self::PARAM_LEVEL_CODE) !== false) {
            $search[] = self::PARAM_LEVEL_CODE;
            $replace[] = LogLevel::getLevelCode($level);
        }

        if (strpos($this->messageFormat, self::PARAM_LEVEL) !== false) {
            $search[] = self::PARAM_LEVEL;
            $replace[] = $level;
        }

        $result = str_replace($search, $replace, $this->messageFormat).PHP_EOL;

        return $result;
    }
}