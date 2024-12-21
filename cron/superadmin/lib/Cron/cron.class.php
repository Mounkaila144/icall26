<?php

class cron extends mfObject2 {
    
    protected static $fields=array('name','title','task','period','is_active','site','last_execution');
    protected static $fieldsNull=array('last_execution'); 
    protected $report=null;
    const table="t_cron";    
    
    function __construct($parameters=null) {
        $this->getDefaults();
        if ($parameters === null) return $this;
        
        if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['id']))
                return $this->loadbyId(intval((string)$parameters['id']));
            return $this->add($parameters);
        }
        else {
            if (is_numeric((string)$parameters))
                $this->loadbyId((string)$parameters);
            else
                $this->loadbyName((string)$parameters);
        }
    }
   
    protected function loadByName($name)
    {
        $this->name=$name; 
        $db=mfSiteDatabase::getInstance();
        $db->setParameters($name)
            ->setQuery("SELECT  *  FROM ".self::getTable()." WHERE name='%s';")
            ->makeSqlQuerySuperAdmin();  
        $this->rowtoObject($db);
        return $this;
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT  *  FROM ".self::getTable()." WHERE ".self::getTableKey()."=%d;")
            ->makeSqlQuerySuperAdmin();  
    }
    
    protected function getDefaults()
    {
       $this->is_active=isset($this->is_active)?$this->is_active:"NO";
       $this->last_execution=isset($this->last_execution)?$this->last_execution:null;
       $this->next_execution=isset($this->next_execution)?$this->next_execution:null;
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuerySuperAdmin();  
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSqlQuerySuperAdmin();  
    }
    
    protected function executeDeleteQuery($db)
    { 
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSqlQuerySuperAdmin();  
    }
      
    
    /*public function add($parameters)
    {
        if (isset($parameters['minutes'])&&isset($parameters['hours'])&&isset($parameters['days'])&&isset($parameters['weekdays'])&&isset($parameters['months']))
           $this->setPeriod($parameters['minutes'],$parameters['hours'],$parameters['days'],$parameters['weekdays'],$parameters['months']);
        return parent::add($parameters);
    }*/
    
     
    public function setPeriod($minutes,$hours,$days,$weekdays,$months)
    {
        $this->set('period',$minutes."|".$hours."|".$days."|".$months."|".$weekdays);
        return $this;
    }
    
    public function setLastExecution()
    {
       $this->set('last_execution',date("Y-m-d H:i:s",time()));
       return $this;
    }
    
    public function getReport()
    {
        if (!$this->report)
             $this->report= new cronReport($this->get('name'));
        return $this->report;
    }
    
    public function disable()
    {
        $this->set('is_active','NO');
        $this->save();
    }
    
}

