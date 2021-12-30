<?php

namespace Logger\Handlers;

use Exception;
use Logger\LogLevel;

class FileHandler extends BaseHandler 
{
    protected $filename;
    protected $fileHandler;
    protected $formatter;

    public function __construct(array $params)
    {
        $this->checkParams($params);

        parent::__construct($params);

        $this->filename = $params['filename'];
        $this->formatter = $params['formatter'];

        if (!($this->fileHandler = fopen($params['filename'], 'a'))) {
            throw new Exception("FileHandler: can't open the file {$this->filename}");
        }
    }

    public function __destruct()
    {
        fclose($this->fileHandler);
    }

    public function log(string $level, string $message): void
    {
        if (!$this->isEnabled || !$this->checkLogLevel($level)) {
            return;
        }

        $message = $this->formatter->processMessage($level, $message);

        if (fwrite($this->fileHandler, $message) === false) {
            throw new Exception("FileHandler: can't write to file {$this->filename}");
        }
    }

    protected function checkParams(array $params): void
    {
        if (empty($params['filename'])) {
            throw new Exception('FileHandler: construct parameter must have a filename value');
        }

        if (empty($params['formatter'])) {
            throw new Exception('FileHandler: construct parameter must have a formatter value');
        }
    }
}