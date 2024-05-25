<?php

namespace Library;

class log
{
    public static function write(string $message): void
    {
        $filename = __DIR__ . '/../logs/app.log';

        $fp = fopen($filename, 'a');

        if (is_writable($filename)) {
            fwrite($fp, sprintf("[%s] %s\n", date('d/m/Y H:i:s'), $message));
        }

        fclose($fp);
    }
}
