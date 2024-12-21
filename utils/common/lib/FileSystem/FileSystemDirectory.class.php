<?php

class FileSystemDirectory   {
    
    protected $directory=null;
    
    function __construct($directory) {
        $this->directory=$directory;
    }
    
    function getPath()
    {
        return $this->directory;
    }
    
    function getNumberOfFiles($flags=FilesystemIterator::SKIP_DOTS)
    {         
         return iterator_count(new FilesystemIterator($this->getPath(), $flags));
    }
    
    function __toString()
    {
        return (string)$this->directory;
    }
    
    
}
