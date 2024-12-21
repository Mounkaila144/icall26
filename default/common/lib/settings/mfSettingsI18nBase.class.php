<?php


class mfSettingsI18nBase extends mfSettingsBase {
    
   protected $culture=null;
    
    function __construct($culture='',$data=null,$name=null,$application=null,$site=null)
    {
       $this->culture=$culture;
       parent::__construct($name,$data,$application,$site);       
    }
    
    function getCulture()
    {
        return $this->culture;
    }
    
    
    protected function getCacheFile()
    {
         return sprintf("%s/%s/%s/data/settings/i18n/%s/%s.dat",
                mfConfig::get('mf_sites_dir'),
                $this->getSite(),
                $this->getApplication(),
                $this->getCulture(),
                $this->getName());
    }
    
   
}

