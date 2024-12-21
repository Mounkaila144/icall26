<?php

 
class SiteTextBase extends mfObject3 {
    
    const table="t_site_text";     
    protected static $fields=array('module','key','value');  

    
   
  function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);    
    $this->getDefaults();  
    if ($parameters===null) return $this;  
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
           if (isset($parameters['id']))
               return $this->loadById((string)$parameters['id']);
          /* if (isset($parameters['name']))
               return $this->loadByName((string)$parameters['name']); */
           return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
             $this->loadbyId((string)$parameters);
      }   
    }
    
    
    protected function getDefaults()
    {	
	 
    }    
     
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('module'=>$this->module,'key'=>$this->key,$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE   module='{module}' AND `key`='{key}' ".$key_condition)
         ->makeSiteSqlQuery($this->site); 
    }
    
    
    protected function updateValues()
    {
       $db=mfSiteDatabase::getInstance()
                   ->setParameters(array('value'=>$this->get('value'),'key'=>$this->get('key')))
                   ->setQuery("UPDATE ".self::getTable().
                              " SET value='{value}'".
                              " WHERE `key`='{key}'".               
                              ";")                                                        
                   ->makeSiteSqlQuery($this->getSite());     
       return $this;
    }
    
    function save()
    {
        mfFileSystem::net_rmdir(mfConfig::get('mf_site_app_cache_dir')."/site/texts");
        if ($this->hasPropertyChanged('value'))
           return $this->updateValues();
        if ($this->hasPropertyChanged('key'))
            return parent::save()->updateValues();   
        return parent::save();        
    }
    
    static function loadByModule($module="",$site=null)
    {
         if (!mfModule::isModuleInstalled('site_text'))
             return ;      
         $file = new File(mfConfig::get('mf_site_app_cache_dir')."/site/texts/".$module.".csv");                
         if (!$file->isExist())
         {    
            $texts=new mfArray();
            $db=mfSiteDatabase::getInstance()
                   ->setParameters(array('module'=>$module))
                   ->setQuery("SELECT * FROM ".self::getTable().
                              " WHERE module='{module}'".               
                              ";")                                                        
                   ->makeSiteSqlQuery($site); 
            if (!$db->getNumRows())
                return $texts;
           while ($item=$db->fetchObject('SiteText'))
           {
              $texts[]=sprintf('"%s";"%s"',$item->get('key'),$item->get('value')); 
           } 
           $file->putContent($texts->implode("\n"));
         }       
         $tmp=__('');
         mfcontext::getInstance()->getI18n()->loadMessages($file->getFile(),'messages');
    }
    
    
    static function getModulesForSelect($site=null)
    {
        $list=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT module FROM ".self::getTable().
                           " GROUP BY module".
                           " ORDER BY module ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;
        while ($item=$db->fetchArray())
        { 
             $list[$item['module']]=$item['module'];
        }              
        return $list;
        
        
    }
}



