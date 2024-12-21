<?php


class SiteServicesSiteCollection extends mfObjectCollection2{
    
    function __construct($data=null) {
        parent::__construct($data);
    }
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
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
    
     function getCollectionKeys()
    {
        return new mfArray(parent::getCollectionKeys());
    }

  /* function removeDouble()
   {
        $hosts=new mfArray();
        foreach ($this->collection as $host)
            $hosts[]=$host->get('host');       
       //checher tous les hosts de la collection
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("SELECT host FROM ".SiteServicesSite::getTable().                          
                           " WHERE ".SiteServicesSite::getTableField('host')." IN('".$hosts->implode("','")."')".  
                            ";")  
                ->makeSqlQuerySuperAdmin();   
        if (!$db->getNumRows())
            return $this;
        while ($row=$db->fetchArray())         
           unset($this->collection[$row['host']]);        
        return $this;
   }*/

}
