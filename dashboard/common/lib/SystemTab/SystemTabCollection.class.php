<?php


class SystemTabCollection extends mfObjectCollection3 {
    
    function __construct($data = null, $site = null) {
        if (is_string($data))
        {
           parent::__construct(null, $site); 
           $this->data=$data;
           return ;
        }    
        parent::__construct($data, $site);
    }
    
    function getAll()
    {        
        if ($this->isLoaded() || !is_string($this->data))
           return $this;        
        $db=mfSiteDatabase::getInstance()
               ->setParameters(array('tab'=>$this->data))
               ->setQuery("SELECT * FROM ". SystemTab::getTable().  
                          " WHERE tab='{tab}'".
                          " ORDER BY position ASC".
                          ";")               
               ->makeSqlQuery(); 
           if (!$db->getNumRows())
               return $this;            
           while ($item=$db->fetchObject('SystemTab'))
           {
              $this[$item->get('name')]=$item->loaded();
           }     
           $this->loaded();
       return $this;
    }
}

