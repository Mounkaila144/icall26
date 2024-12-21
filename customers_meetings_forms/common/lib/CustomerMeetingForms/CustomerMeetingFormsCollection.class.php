<?php

class CustomerMeetingFormsCollection extends mfObjectCollection2 {
    
    function __construct($data=null,$site=null) {
        parent::__construct($data, null, $site);
    }
    
    
     protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site); 
    }
    
    
    function clearInProgress()
    {
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                       
            ->setQuery("UPDATE ".CustomerMeetingForms::getTable().                      
                       " SET is_processed = 'NO'".
                       ";")
            ->makeSiteSqlQuery($this->getSite());      
        return $this;
    }
    
    function getContratIds()
    {
        if ($this->contract_ids===null)
        {    
            $this->contract_ids=new mfARray();
            foreach ($this as $item)
            {
                if ($item->get('contract_id'))
                    $this->contract_ids[]=$item->get('contract_id');
            }                
        }
        return $this->contract_ids;
    }
    
    function getMeetingIds()
    {
        if ($this->meeting_ids===null)
        {    
            $this->meeting_ids=new mfARray();
            foreach ($this as $item)
            {
                if ($item->get('meeting_id'))
                    $this->meeting_ids[]=$item->get('meeting_id');
            }                
        }
        return $this->meeting_ids;
    }
}

