<?php

class MarketingLeadsWpFormsLeadsImportFormatBase extends mfObject2 {
    
    protected static $fields=array('name','columns','parameters','help','class','created_at','updated_at');
    const table="t_marketing_leads_format_import"; 
    protected static $foreignKeys=array();  
    protected $fields_values=array();
    
    function __construct($parameters=null) {
        parent::__construct();   
        $this->getDefaults(); 
        if ($parameters === null)  return $this;      
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {
            if (isset($parameters['id']))
               return $this->loadbyId((string)$parameters['id']); 
            // Import         
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
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';");        
        $db->makeSqlQuery();         
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");           
    }
     
    protected function executeInsertQuery($db)
    {     
        $db->makeSqlQuery(); 
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));      
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;");      
        $db->makeSqlQuery();        
    }
    
    protected function executeDeleteQuery($db)
    {         
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;");
        $db->makeSqlQuery();        
    }
    
    protected function executeIsExistQuery($db)    
    {
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!={id};":"";
        $db->setParameters(array('name'=>$this->get('name'),'id'=>$this->getKey()))
            ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' ".$key_condition)
            ->makeSiteSqlQuery($this->site);     
    }
        
    function setFieldsValues($fields_values)
    {
        $this->set('columns',serialize($fields_values));
        return $this;
    }
    
    function getFieldsValues()
    {
        if (!$this->fields_values)
            $this->fields_values= unserialize($this->get('columns'));
        return $this->fields_values;
    }
    
    function getNamesValues()
    {
        $values=array();
        foreach ($this->getFieldsValues() as $name=>$value)
        {
            $values[]=array('name'=>$name,'value'=>$value);
        }    
        return $values;
    }
    
    static function getFormatForSelect($site=null)
    {
        $values=array();            
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".MarketingLeadsWpFormsLeadsImportFormat::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('MarketingLeadsWpFormsLeadsImportFormat'))
        { 
            $values[$item->get('id')]=$item->get('name');
        }      
        return $values;
    }
}
