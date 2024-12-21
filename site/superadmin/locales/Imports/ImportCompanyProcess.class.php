<?php


class ImportCompanyProcess extends CsvFile {
    
    protected $file=null;
    
    function __construct( mfValidatedFile $file) {               
        parent::__construct($file->getTempName());
    }  
    
    function process()
    {            
        $rows=$this->getData();                    
        foreach ($rows as $line)
        {    
            $site= new Site($line[0]);
            if ($site->isNotLoaded())
                continue;           
            if ($line[2])
            {    
                $site->set('site_company',$line[1]);
                $site->save();            
            }    
        }     
        return $this;
    }
    
}
