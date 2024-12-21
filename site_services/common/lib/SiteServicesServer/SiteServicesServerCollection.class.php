<?php


 
class SiteServicesServerCollection extends  mfObjectCollection2 {
    
    function __construct($data=null)
    {        
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
       $db ->makeSqlQuerySuperAdmin();   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".$this->getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin();   
    }
    
    function getCollectionKeys()
    {
        return new mfArray(parent::getCollectionKeys());
    }
    
    function getNames()
    {
        $values=new mfArray();
        foreach ($this->collection as $item)
            $values[]=$item->get('name');
        return $values;
    }
     function updateIsActive()
   {    
         
           $db = mfSiteDatabase::getInstance();
           $db->setParameters(array())  
                ->setQuery("UPDATE ".SiteServicesSite::getTable().                          
                         " SET " . SiteServicesSite::getTableField('is_active') ."='NO'".
                         " WHERE server_id IN('".$this->getKeys()->implode("','")."');")
                  ->makeSiteSqlQuery($this->site);    
         //  echo $db->getQuery();
   }
   
     function inprogress()
    {
         $db=mfSiteDatabase::getInstance()
                         ->setParameters(array())           
            ->setQuery("UPDATE ".SiteServicesServer::getTable()." SET is_inprogress='YES'".
                       " WHERE id IN('".$this->getKeys()->implode("','")."');")
           ->makeSqlQuery($this->site);         
        return $this;
    }
    
    function resetAll()
    {
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array())
           ->setQuery("UPDATE ".SiteServicesServer::getTable().
                      " SET ".SiteServicesServer::getTableField('is_processed')." = 'NO',".
                                    SiteServicesServer::getTableField('is_inprogress')." =  'NO' ".
                      ";")
           ->makeSiteSqlQuery($this->site); 
        return $this;
    }
     function done()
    {
         $db=mfSiteDatabase::getInstance()
                         ->setParameters(array())           
            ->setQuery("UPDATE ".SiteServicesServer::getTable()." SET is_inprogress='YES',is_processed='YES' ".
                       " WHERE id IN('".$this->getKeys()->implode("','")."');")
           ->makeSqlQuery($this->site); 
        return $this;
    }
    
}

