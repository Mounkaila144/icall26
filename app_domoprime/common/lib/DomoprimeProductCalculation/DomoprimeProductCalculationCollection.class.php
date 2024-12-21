<?php


class DomoprimeProductCalculationCollection extends mfObjectCollection2 {
    
    
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
    
    
    function toArrayForDocumentPdf()
    {
        if ($this->document_values===null)
        {    
             $settings_type_product=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();
             foreach ($this as $item)
             {
                 $this->document_values[$settings_type_product[$item->get('product_id')]]=$item->toArrayForDocumentPdf();
             }    
        }
        return $this->document_values;
    }
}

