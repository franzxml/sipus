<?php
// app/Models/ActivityLogger.php

namespace App\Models;

class ActivityLogger
{
    protected static string $logFile = __DIR__ . '/../../storage/logs/activity.log';

    // Method static untuk mencatat log
    public static function log(string $message): void
    {
        $time = date('Y-m-d H:i:s');
        $entry = "[$time] $message" . PHP_EOL;
        file_put_contents(self::$logFile, $entry, FILE_APPEND);
    }

    // Late static binding: agar method bisa dioverride di subclass
    public static function info(string $message): void
    {
        static::log("INFO: $message");
    }

    public static function warning(string $message): void
    {
        static::log("WARNING: $message");
    }

    public static function error(string $message): void
    {
        static::log("ERROR: $message");
    }
}