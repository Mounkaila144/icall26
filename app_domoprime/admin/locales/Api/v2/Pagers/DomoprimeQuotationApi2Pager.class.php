<?php

require_once __DIR__."/../../../Pagers/DomoprimeQuotationPager.class.php";

class DomoprimeQuotationApi2Pager extends DomoprimeQuotationPager {

      
    
    protected function fetchObjects($db)
    {              
        parent::fetchObjects($db);    
        foreach ($this as $item)
            $item->products=new DomoprimeQuotationProductCollection();       
        $db=mfSiteDatabase::getInstance()
                   ->setParameters(array())
                   ->setObjects(array('DomoprimeQuotationProduct','Product',))
                   ->setQuery("SELECT {fields} FROM ".DomoprimeQuotationProduct::getTable().  
                              " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id').
                              " WHERE quotation_id IN('".(string)mfArray::create($this->getKeys())->implode("','")."')".
                              ";")
                   ->makeSqlQuery();                
         if (!$db->getNumRows())
              return ;                              
         while ($items=$db->fetchObjects())
         {                     
             $item=$items->getDomoprimeQuotationProduct();
           //  echo $item->get('quotation_id');
              if (!isset($this->items[$item->get('quotation_id')]))
                  continue;
             $item->set('product_id',$items->getProduct());           
              $this->items[$item->get('quotation_id')]->getProducts()->push($item);
          }         
    }
  
}

