<?php

class Log{
    private $path = __DIR__ . '../../logs';

    /**
     * Summary of filelog
     * @param string $message
     * @return void
     */
    public function filelog(string $message){
        if (!is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }
        error_log($message, 3, $this->path. '/errors.log');
    }
}