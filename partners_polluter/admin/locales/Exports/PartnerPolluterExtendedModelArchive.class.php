<?php

 
class PartnerPolluterExtendedModelArchive  extends ZipArchive {
  
    
protected $polluter=null,$selection=null;
    
    function __construct(DomoprimePollutingCompany $polluter,PartnerPolluterModelCollection $selection) {
        $this->polluter=$polluter;
        $this->selection=$selection;
         mfFileSystem::mkdirs($this->getPath());            
    }
    
    function getPolluter()
    {
        return $this->polluter;
    }
    
   /* function getTempPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/exports/".$this->getPolluter()->get('id')."/items";
    }*/
    
    function getPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/exports/polluters/".$this->getPolluter()->get('id')."/archive/models";
    }
    
    function getName()
    {
        return $this->getPolluter()->getNameAlphaNum("-")."-".__("models").".zip";//$this->getPolluter()->getNameAlphaNum("-").".zip";
    }
    
    function getFilename()
    {
        return $this->getPath()."/".$this->getName();
    }
    
    function getSelection()
    {
        return $this->selection;
    }
    
    function process()
    {     
         if ($res=$this->open($this->getFilename(), ZipArchive::CREATE|ZipArchive::OVERWRITE)===false)                
            return false;         
        foreach ($this->getSelection() as $model)
        {
          if (!$model->hasI18n())
                continue;
          if (!$model->getI18n()->hasFile())
              continue;
          $xml=new PartnerPolluterModelI18nXML($model->getI18n());
          $xml->save();
          
          $this->addFile($xml->getFilename(),$xml->getName());              
          $this->addFile($model->getI18n()->getFile()->getFile(),$model->getI18n()->getEscapedValue().".".$model->getI18n()->getFile()->getExtension());                        
        }    
        $this->close();
        return $this;
    }
 
    
   
}

