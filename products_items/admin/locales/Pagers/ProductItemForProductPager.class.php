<?php


class ProductItemForProductPager extends Pager {


    function __construct()
    {             
       parent::__construct(array('ProductItem','Tax'));             
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getProductItem();                                              
              $item->set('tva_id',$items->hasTax()?$items->getTax():false);                               
              $this->items[$item->get('id')]=$item;                            
       }          
    }
   
    
    
}

