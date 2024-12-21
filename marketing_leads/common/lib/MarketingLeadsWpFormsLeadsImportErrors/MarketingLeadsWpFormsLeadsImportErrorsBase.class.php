<?php

	
class MarketingLeadsWpFormsLeadsImportErrorsBase extends mfObject2 {
    
    protected static $fields=array('import_id','line','file','error_text','status','created_at','updated_at');
    const table="t_marketing_leads_errors_import"; 
    protected static $foreignKeys=array('import_id'=>'MarketingLeadsWpFormsLeadsImportFile',
                                        );
    
    function __construct($parameters=null) {
        parent::__construct();   
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
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';");        
        $db->makeSqlQuery();         
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");    
        $this->status=isset($this->status)?$this->status:'ACTIVE';          
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
        
    }
    
    function setImport($import)
    {
        $this->set('import_id',$import);
        return $this;
    }
    
    function getImport()
    {
        if (!$this->_import_id)
        {
            $this->_import_id=new MarketingLeadsWpFormsLeadsImportFile($this->get('import_id'));
        }    
        return $this->_import_id;
    }
    
    function dispalyErrorsAsTab()
    {
        return unserialize($this->get("error_text"));
    }
    
    function getErrorFields()
    {
        $errors = $this->dispalyErrorsAsTab();
        $fields = array();
        foreach($errors as $field=>$error)
        {
            $fields[] = $field;
        }
        return $fields;
    }
    
    static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())                
            ->setQuery("DELETE FROM ".MarketingLeadsWpFormsLeadsImportFile::getTable().";")               
            ->makeSiteSqlQuery($site);
        $db->setQuery("DELETE FROM ". MarketingLeadsWpFormsLeadsImportFormat::getTable().";")               
            ->makeSiteSqlQuery($site);
    }    
}
