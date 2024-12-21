<?php

class languageBase extends  orderedObject  {

    protected static $fields=array('id','code','position','is_active','application','created_at','updated_at');
    const table="t_languages";
            
    function __construct($parameters=null,$application=null,$site=null) {
      parent::__construct($application,$site);
      $this->_getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['id']))
               return $this->loadById((string)$parameters['id']);
            $this->add($parameters); 
       }  
       else
       {
           if (is_numeric((string)$parameters)) 
                $this->loadById((string)$parameters);             
           else
               $this->loadByCode((string)$parameters);             
       } 
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE id=%d AND application@@IN_APPLICATION@@ LIMIT 1;")
            ->makeSqlQuery($this->application,$this->site);  
    }
    
    protected function loadByCode($code)
    {
         $db=mfSiteDatabase::getInstance()->setParameters(array($code));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE code='%s' AND application@@IN_APPLICATION@@ LIMIT 1;")
            ->makeSqlQuery($this->application,$this->site);  
         return $this->rowtoObject($db);
    }
    
    protected function executeDeleteQuery($db)
    {
         $db->setQuery("DELETE FROM ".self::getTable()." WHERE id=%d AND application@@IN_APPLICATION@@;")
                  ->makeSqlQuery($this->application,$this->site);   
    }

    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
   
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSqlQuery($this->application,$this->site);   
    }
    
    protected function _getDefaults()
    {
         $this->created_at=date("Y-m-d H:i:s");  
         $this->updated_at=date("Y-m-d H:i:s");
         $this->is_active=isset($this->is_active)?$this->is_active:"NO";
    }
    
     protected function getDefaults()
    {
         $this->_getDefaults();
         parent::getDefaults();
    }
    
    protected function executeInsertQuery($db)
    {
        $db->makeSqlQuery($this->application,$this->site);   
    }
    
    protected function executeLastPositionQuery($db)
    {
     $db->setQuery("SELECT max(position) FROM ".static::getTable()." WHERE application@@IN_APPLICATION@@;")
        ->makeSqlQuery($this->application,$this->site); 
    }
    
    protected function executeShiftUpQuery($db)
    {
       $db->setQuery("UPDATE ".static::getTable()." SET position=position + 1 WHERE position < %d AND position >= %d AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site);   
    }
    
    protected function executeShiftDownQuery($db)
    {
        $db->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND position <= %d AND application@@IN_APPLICATION@@;")
            ->makeSqlQuery($this->application,$this->site); 
    }
    
    protected function executeShiftQuery($db)
    {
        $db->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site); 
    }
    
    protected function executeSiblingQuery($db)
    {
       $db->setQuery("SELECT * FROM ".static::getTable()." WHERE position={position} AND application@@IN_APPLICATION@@;")
          ->makeSqlQuery($this->application,$this->site);     
    }
    
  /* ** M E T H O D S **************************************************** */  
    function __toString()
    {
        return $this->get('code'); 
    }
    
    public function getI18nLanguage()
    {
        return format_country($this->get('code'));
    }
}


