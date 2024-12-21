<?php

class MarketingLeadsWpFormsStatusBase extends mfObject2 {
     
    protected static $fields=array('name','icon','color');
    const table="t_marketing_leads_wp_forms_status"; 
    
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
            return $this->loadbyName((string)$parameters);  
        }   
    }
    
    protected function loadByName($name)
    {
        $this->set('name',$name);
        $db=mfSiteDatabase::getInstance()->setParameters(array($name));
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s';")
           ->makeSiteSqlQuery($this->site);                           
        return $this->rowtoObject($db);
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
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/marketing/leads/status/".$this->get('id');
    }  
    /* =================================== P I C T U R E =========================================== */
    
    public function getIcon()
    {
        if (!$this->get('_icon'))      
        {    
           $this->_icon=new PictureObject2(array(
                      "path"=>$this->getDirectory(),
                      "picture"=>$this->get('icon'),
                      "urlPath"=>url("/nocache/data/marketing/leads/status/".$this->get('id')."/","web","frontend"),
                      "url"=>url("/nocache/data/marketing/leads/status/".$this->get('id')."/".$this->get('icon'),"web","frontend")
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
 
    public function setMarketingLeadsWpFormsStatusI18n($status_i18n)
    {
        $this->_status_i18n=$status_i18n;
        return $this;
    } 
    
    public function hasMarketingLeadsWpFormsStatusI18n()
    {
//        var_dump($this->_status_i18n===null);
        return $this->_status_i18n!==null;
    } 
     
    function setI18n($i18n)
    {
        $this->_status_i18n=$i18n;
        return $this;
    }
    
    public function getMarketingLeadsWpFormsStatusI18n($lang=null)
    {
        //$this->_status_i18n=$status_i18n;
        if ($this->_status_i18n===null)
        {
            if ($lang==null)
               $lang =  mfcontext::getInstance()->getUser()->getCountry();
            $this->_status_i18n = new MarketingLeadsWpFormsStatusI18n(array('lang'=>$lang,"status_id"=>$this->get('id')),$this->getSite());
        }   
//        var_dump($this->_status_i18n);
        return $this->_status_i18n;
    } 

    function getI18n($lang=null)
    {
        return $this->getMarketingLeadsWpFormsStatusI18n($lang);
    }

    function toArrayForTransfer()
    {
        $values=parent::toArray(array('name','color'));
        $values['value']=(string)$this->getI18n();         
        return $values;
    }
    
    static function getStatusWithI18nForSelect($site=null)
    {
        $status = new mfArray();
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array())
           ->setObjects(array("MarketingLeadsWpFormsStatus","MarketingLeadsWpFormsStatusI18n"))
           ->setQuery("SELECT {fields} FROM ".MarketingLeadsWpFormsStatus::getTable().
                      " INNER JOIN ".MarketingLeadsWpFormsStatusI18n::getInnerForJoin('status_id')
                    )
           ->makeSiteSqlQuery($site);
       
        if(!$db->getNumRows())
            return $status;
       
        while($items = $db->fetchObjects())
        {
            $item = $items->getMarketingLeadsWpFormsStatus();
            $status[$item->get('id')] = $items->getMarketingLeadsWpFormsStatusI18n();
        }
       
        return $status;
    }
    
}
