<?php

class GroupImportFileForm extends mfFormSite {

    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }

    function configure() { 
        $this->setValidators(array(      
          //  'file'=>new mfValidatorFile(array('max_size'=>500000,'mime_types'=>array( 'text/plain','text/csv', 'text/comma-separated-values')))
            'file'=>new mfValidatorZipFile(array('max_size'=>5000000)),         
            'ftp'=>new mfValidatorFileForImport(array('path'=>Site::getFtpDirectory('/imports/users',$this->getSite()),'mime_types'=>array('application/zip'))),
                ));
        if ($this->getDefault('ftp'))
            $this->file->setOption('required',false);
        else
            $this->ftp->setOption('required',false);   
    }
    
    function getFile()
    {
       if ($this->hasValue('file'))
       {    
           $file=$this->getValue('file')->getTempName(); // Site Save in archive                        
       }
       else
       {                     
           $file=$this->getValue('ftp')->getFile(); // Site Save in archive    
       }   
       return $file;
    }
    
}