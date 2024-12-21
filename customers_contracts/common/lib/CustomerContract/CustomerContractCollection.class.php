<?php


 
class CustomerContractCollection extends mfObjectCollection2 {
    
    protected $customers=null;
    
    function __construct($data=null,$site=null)
    {        
      parent::__construct($data,null,$site);
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
        $db->setQuery("UPDATE ".$this->getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    

    function getSignature()
    {
        return md5(implode(",",$this->getKeys()));
    }
    
    function byPartners()
    {
        $partners = new PartnerCollection(null,$this->getSite());
        foreach ($this->collection as $item)
        {
             if (!$item->hasPartner()) 
                 continue;
             if (!isset($partners[$item->get('financial_partner_id')]))
                    $partners[$item->get('financial_partner_id')]=$item->getPartner();
             $partners[$item->get('financial_partner_id')]->addContract($item);
        }   
        return $partners;
    }
            
}

