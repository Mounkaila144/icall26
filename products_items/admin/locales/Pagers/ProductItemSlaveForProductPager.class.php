<?php


class ProductItemSlaveForProductPager extends Pager {


    function __construct()
    {             
       parent::__construct(array('ProductItem','Tax','ProductItemsItem'));             
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getProductItem();                                              
              $item->set('tva_id',$items->hasTax()?$items->getTax():false);
              $item->item=$items->getProductItemsItem();
              $this->items[$item->get('id')]=$item;                            
       }          
    }
   
    
    
}

