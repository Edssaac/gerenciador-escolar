<?php

namespace Library;

class log
{
    public static function write(string $message): void
    {
        $filename = __DIR__ . '/../logs/app.log';

        if (is_writable($filename)) {
            if (!$fp = fopen($filename, 'a')) {
                exit;
            }

            if (fwrite($fp, sprintf("[%s] %s\n", date('d/m/Y H:i:s'), $message)) === FALSE) {
                exit;
            }

            fclose($fp);
        }
    }
}
