<?php


class LogFile extends File {
    
    function __construct($file)
    {
        if ($file)
            parent::__construct(LogsUtils::getLogDirectory()."/".$file);
    }
    
    
}

