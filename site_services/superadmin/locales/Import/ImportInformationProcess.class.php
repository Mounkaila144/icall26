<?php


class ImportInformationProcess extends CsvFile {
    
    protected $file=null;
    
    function __construct( mfValidatedFile $file) {               
        parent::__construct($file->getTempName());
    }  
    
    function process()
    {            
        $rows=$this->getData();                    
        foreach ($rows as $line)
        {    
            $site= new SiteServicesSite($line[0]);
            if ($site->isNotLoaded())
                continue ;
            if ($line[2])
                $site->set('description',$line[2]);
            if ($line[1])
                $site->set('company',$line[1]);
            if ($line[2] || $line[1])
                $site->save();            
        }     
        return $this;
    }
    
}
