<?php

class TextEmailI18nBase extends mfObject2 {
    
    const table="t_text_email_i18n";
    const key=null;   
    protected static $fields=array('module','lang','key','subject','body');   
    protected static $keys=array('lang','key','module');   
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);
      if ($parameters === null)
            return $this;
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['module']) && isset($parameters['lang']) && isset($parameters['key']))
              return $this->loadbyModuleAndLangAndKey((string)$parameters['module'],(string)$parameters['lang'],(string)$parameters['key']);         
      }   
      return $this->add($parameters); 
    }
   
    protected function loadByModuleAndLangAndKey($module,$lang,$key)
    {
        $this->set('key',$key);
        $this->set('lang',$lang);
        $this->set('module',$module);
        $db=mfSiteDatabase::getInstance()->setParameters(array('lang'=>$lang,'key'=>$key,'module'=>$module));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE module='{module}' AND lang='{lang}' AND `key`='{key}';")
            ->makeSiteSqlQuery($this->site);                           
        return $this->rowtoObject($db); 
    }        
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereKeysCondition().";")
          ->makeSiteSqlQuery($this->site);
    }
       
    
    protected function executeInsertQuery($db)
    {
        $db->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".$this->getWhereKeysCondition().";")
           ->makeSiteSqlQuery($this->site);    
    }
    
    protected function executeIsExistQuery($db)
    {
       $db->setParameters($this->getWhereKeysParameters())
         ->setQuery("SELECT * FROM ".self::getTable()." WHERE ".$this->getWhereKeysCondition().";")
         ->makeSiteSqlQuery($this->site); 
    }
    
    /* ================== C A C H E ================================================== */
    function removeTextI18nCache()
    {             
       $file=mfConfig::get('mf_cache_dir')."/sites/".$this->getSite()->getHost()."/frontend/".mfConfig::get('mf_environment').
                           "/i18n/".$this->get('lang')."/emails/".$this->get('module')."/".$this->get('key')."/messages.csv";                   
     //  $file=mfConfig::get('mf_site_app_cache_dir')."/i18n/".$this->get('lang')."/emails/".$this->get('module')."/".$this->get('key')."/messages.csv";                   
       if (is_readable($file))
           unlink($file);                
    }
    
    function save()
    {
        parent::save();
        $this->removeTextI18nCache();
    }
}
