<?php


class DomoprimeProductSectorEnergyCollection extends mfObjectCollection2 {
    
    
     function __construct($data=null,$site=null) {
         parent::__construct($data,null, $site);
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
    
     function getTotalQmac()
    {
        return $this->total_qmac;
    }
    
     function getTotalValueQmac()
    {
        return $this->total_value_qmac;
    }
    
      function getTotalPose()
    {
        return $this->total_pose;
    }
    
     function getTotalMargin()
    {
        return $this->total_margin;
    }
    
    function process($engine)
    {
        foreach ($this->collection as $item)
        {
            $item->process($engine);
            $this->total_qmac += $item->getTotalQmac();
            $this->total_value_qmac += $item->getTotalValueQmac();
            $this->total_pose+=$item->getTotalPose();
            $this->total_margin+=$item->getTotalMargin();
        }    
    }
}

