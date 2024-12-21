<?php

class CustomerContractInstallStatusBase extends mfObject2 {
     
    protected static $fields=array('name','icon','color');
    const table="t_customers_contracts_install_status"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         
      }   
    }
    
  
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
      
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
      
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/customers/contracts/status/install/admin/".$this->get('id');
    }  
    /* =================================== P I C T U R E =========================================== */
    
    public function getIcon()
    {
      if (!$this->get('_icon'))      
      {    
         $this->_icon=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('icon'),
                 "urlPath"=>url("/nocache/data/customers/contracts/status/install/admin/".$this->get('id')."/","web","frontend"),
                 "url"=>url("/nocache/data/customers/contracts/status/install/admin/".$this->get('id')."/".$this->get('icon'),"web","frontend")
              ));
      }
      return $this->_icon;     
    }
    
    public function deleteIcon()
    {
        $this->getIcon()->remove(); 
        $this->set('icon','');
        $this->save();
    }       
    
    function setIconName($filename)
    {
       $this->set('icon',self::getName($filename));
       return $this->get('icon');
    }
    
    static function getName($name)
    {
       return str_replace(" ","-",mfTools::I18N_noaccent($name));
    }     
    
      public function setI18n($i18n)
     {
         $this->i18n=$i18n;
         return $this;
     } 
     
     public function getI18n($lang=null)
     {         
         if (!$this->i18n)
         {
             if ($lang==null)
                  $lang=  mfcontext::getInstance()->getUser()->getCountry();
             $this->i18n=new CustomerContractInstallStatusI18n(array('lang'=>$lang,"status_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
      
     
     static function getStatusForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerContractInstallStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContractInstallStatusI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerContractInstallStatusI18n'))
        { 
            $values[$item->get('status_id')]=$item->get('value');
        }      
        return $values;
    }
    
     function toArrayForTransfer()
     {
         $values=parent::toArray(array('name','color'));
         $values['value']=(string)$this->getI18n();         
         return $values;
     }
     
     function save()
     {
         parent::save();
         mfCacheFile::removeCache('contract_install_states','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('contract_install_states','admin',$this->getSite());         
         return $this;
     }
}
