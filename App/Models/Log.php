<?php

class Log{
    private $path = __DIR__ . '/../../logs/errors.log';

    public function filelog(string $message){
        error_log($message, 3, $this->path);

    }
}