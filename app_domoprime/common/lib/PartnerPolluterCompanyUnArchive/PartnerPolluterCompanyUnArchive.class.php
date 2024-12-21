<?php

class PartnerPolluterCompanyUnArchive extends ZipArchive {
    
    protected $polluter=null,$site=null,$options=array();
    
    function __construct( $file,$options=array(),$site=null) {
          $this->site=$site;
          $this->polluter=new PartnerPolluterCompany(null,$site);
          $this->polluter->save();
          $this->file=is_string($file)?$file:$file->getTempName();  
          $this->options=$options;
          $this->configure();
    }
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getOption($name,$defaults=null)
    {
       return isset($this->options[$name])?$this->options[$name]:$defaults; 
    }        
       
    
    function configure()
    {
        mfFileSystem::mkdirs($this->getPath());            
        $this->open($this->getFile());
        $this->extractTo($this->getPath());                                                
        $this->close();
    //    unlink($this->getFile());
        return $this;
    }
    
    function getFile()
    {
        return $this->file;
    }
    
    function getPolluter()
    {
        return $this->polluter;
    }
    
    
    function getPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/imports/".$this->getPolluter()->get('id')."/archive";
    }
 
    
    function process()
    {            
       $polluter_xml = new PartnerPolluterCompanyXmlExtractor($this->polluter,$this->getPath());    
       $polluter_xml->extract(); 
       
       $models_xml= new PartnerPolluterModelCollectionXmlExtractor($this->polluter,$this->getPath());  
       $models_xml->extract();
       
       return $this;
    }
    
}

