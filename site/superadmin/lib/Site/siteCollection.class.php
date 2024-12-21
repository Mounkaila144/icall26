<?php

class siteCollection extends mfObjectCollection2 {   

    function __construct($data=null,$site=null) {
        parent::__construct($data, null, $site);
    }
    
    protected function executeSelectQuery($db)
    {
      $db->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")         
         ->makeSqlQuerySuperAdmin(); 
    }
    
    protected function executeDeleteQuery($db)
    {
        
       $db->setParameters()        
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSqlQuerySuperAdmin(); 
          
    }            
    
    protected function executeInsertQuery($db)
    {
         $db->makeSqlQuerySuperAdmin(); 
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin();  
    }
      
    
    function getHosts()
    {
        $hosts=new mfArray();
        foreach ($this->collection as $item)
           $hosts[]=$item->get('site_host');
        return $hosts;
    }
    
function getDatabases()
{
    $databases=new mfArray();
    foreach ($this->collection as $item)
    {
        if (isset($databases[$item->get('site_db_name')]))
            continue;
        $databases[$item->get('site_db_name')]=$item->get('site_db_name');
    }       
    return $databases;
}
    
    
    function getByName()
    {
         if ($this->isNotLoaded())
         {             
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable().                        
                             " GROUP BY site_db_name".
                             ";")
                  ->makeSqlQuerySuperAdmin();
           if ($db->getNumRows()) 
           {
                while ($row = $db->fetchObject("Site")) {
                    $this[$row->get('site_id')]=$row->loaded();
                }
           }
           $this->loaded();
         }
         return $this;                   
    }
    
    function toArrayForService()
    {
        $values=array();
        foreach ($this as $item)
        {    
            $values[]=$item->toArray();
        }
        return $tvalues;
    }
}

