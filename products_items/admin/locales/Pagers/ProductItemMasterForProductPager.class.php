<?php


class ProductItemMasterForProductPager extends Pager {


     function __construct()
    {  
       parent::__construct(array('ProductItem','Tax','ProductItemsItem'));             
    }        
            
    protected function fetchObjects($db)
    {
       // die(__METHOD__);       
        while ($items = $db->fetchObjects()) 
        {                                  
               $item=$items->getProductItem();   
               if (!isset($this->items[$item->get('id')]))
               {	  
                          $item->set('tva_id',$items->hasTax()?$items->getTax():false);  
                          $this->items[$item->get('id')]=$item; 				    
                }
              //  var_dump($items->getProductItemsItem());
               // die(__METHOD__);
                $this->items[$item->get('id')]->getProductItemSlaves()->addItem($items->getProductItemsItem());                  
        }
    }
   
    
   
    
    
}

