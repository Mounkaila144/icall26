<?php

require_once __DIR__."/../../../Pagers/DomoprimeBillingPager.class.php";

class DomoprimeBillingApi2Pager extends DomoprimeBillingPager {

      
    
     protected function fetchObjects($db)
    {              
        parent::fetchObjects($db);    
        foreach ($this as $item)
            $item->products=new DomoprimeBillingProductCollection();       
        $db=mfSiteDatabase::getInstance()
                   ->setParameters(array())
                   ->setObjects(array('DomoprimeBillingProduct','Product',))
                   ->setQuery("SELECT {fields} FROM ".DomoprimeBillingProduct::getTable().  
                              " INNER JOIN ".DomoprimeBillingProduct::getOuterForJoin('product_id').
                              " WHERE billing_id IN('".(string)mfArray::create($this->getKeys())->implode("','")."')".
                              ";")
                   ->makeSqlQuery();                
         if (!$db->getNumRows())
              return ;                     
         while ($items=$db->fetchObjects())
         {                     
             $item=$items->getDomoprimeBillingProduct();
           //  echo $item->get('billing_id');
              if (!isset($this->items[$item->get('billing_id')]))
                  continue;
             $item->set('product_id',$items->getProduct());           
             $this->items[$item->get('billing_id')]->getProducts()->push($item);
          }         
    }
  
}

