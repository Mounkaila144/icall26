<?php


class ProductsPager extends Pager {


    function __construct()
    {             
       parent::__construct(array('Product','Tax','ProductAction'));             
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getProduct();                                              
              $item->set('tva_id',$items->hasTax()?$items->getTax():null);                 
              $item->set('action_id',$items->hasProductAction()?$items->getProductAction():null);                            
              $this->items[$item->get('id')]=$item;                            
       }          
    }
   
    
    
}

