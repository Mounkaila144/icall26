<?php


class mfPager extends Pager {
       
   /* function getQuery()
   {
       return $this->query;
   }*/
   
    function setQuery($query,$parameters=array())
    {
       $this->parameters=(array)$parameters;
       $this->query=(string)$query;      
       return $this;
    }
    
    function preExecute($db)
    {
        
    }
    
    function postExecute($db)
    {
        
    }
    
    protected function executeQuery($db)
    {                      
            $this->insertFieldsInQuery($db);
            $db->setParameters($this->parameters)
                    ->setQuery($this->query_limit)
                    ->makeSqlQuery($this->application,$this->site);
            $this->rowsToObjects($db);                                
    }
    
          
            
    function execute($application=null,$site=null)
    {      
        $this->setApplicationAndSite($application,$site);        
        $this->prepareQuery();           
        if ($this->count)
        {
           $db=mfSiteDatabase::getInstance();
           $this->preExecute($db);                              
           
           $this->executeQuery($db);                 
           
           $this->postExecute($db); 
        }                  
    }
    
    
 
}
