<?php

class MutualEngineCalculationMutualCollection extends mfObjectCollection2 {
    
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
    
    function setProductsForMutualsCalculation(MutualEngineCalculationProductCollection $calculation_products)
    {
        foreach($calculation_products as $product)
        {
            $this->addProductToMutual($product);
        }
    }
    
    function addProductToMutual(MutualEngineCalculationProduct $product)
    {
        foreach($this->collection as $key=>$mutual_calculation)
        {
            if($mutual_calculation->get('id') == $product->get('mutual_calculation_id'))
            {
                $this->collection[$key]->addProductCalculation($product);
            }
        }
    }
}
