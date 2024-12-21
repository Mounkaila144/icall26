<?php


class CsvImport extends CsvImportBase {
                   
    
    function __construct($file, $options=array(), $site = null) {
        if (is_string($file))
            $file=new File($file);
        if (!$file->isExist())
             throw new mfException(__("csv file [%s] is not found.",$file->getName()));       
        parent::__construct($file->getFile(), $options, $site);
    }                                                                 
     
    function getHeader()
    {
        if (!$this->hasHeader())
            $this->readHeader();
        return parent::getHeader();                
    }
    
     function readHeader()
     {
           $this->open();    
           parent::readHeader();                                  
     }
     
     
                    
}

