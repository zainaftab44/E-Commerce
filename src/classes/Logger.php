<?php

namespace Src\Classes;

use DateTime;
use DateTimeZone;

/**
 * Class Logger
 * @package src\classes
 * 
 * Basic logger class with different log levels.
 */
class Logger
{
    private static $instance = null;
    private $logFile;
    private $timestampFormat = 'D M d Y H:i:s';

    const LEVELS = [
        'ERROR',
        'WARN',
        'NOTICE',
        'ALERT',
        'INFO',
        'DEBUG'
    ];

    private function __construct()
    {
        $this->logFile = fopen(LOG_LOCATION, 'a');
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function log($level, $message, ...$data)
    {
        if (!in_array($level, self::LEVELS)) {
            throw new \InvalidArgumentException("Invalid log level: $level");
        }

        $now = new DateTime("now", new DateTimeZone(TIMEZONE));
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        $logEntry = sprintf(
            "[%s][%s:%s][%s][%s::%s(%d)][%s] %s\n",
            $now->format($this->timestampFormat),
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['REMOTE_PORT'],
            $_SERVER['REQUEST_URI'],
            $trace[2]['class'] ?? '',
            $trace[2]['function'] ?? '',
            $trace[1]['line'] ?? '',
            $level,
            $message
        );

        fwrite($this->logFile, $logEntry);

        foreach ($data as $item) {
            fwrite($this->logFile, print_r($item, true) . "\n");
        }
    }

    public function __call($name, $arguments)
    {
        if (in_array(strtoupper($name), self::LEVELS)) {
            array_unshift($arguments, strtoupper($name));
            call_user_func_array([$this, 'log'], $arguments);
        } else {
            throw new \BadMethodCallException("Method $name does not exist.");
        }
    }
}
?>
