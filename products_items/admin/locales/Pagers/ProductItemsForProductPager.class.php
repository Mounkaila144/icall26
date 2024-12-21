<?php


class ProductItemsForProductPager extends Pager {


     function __construct()
    {             
       parent::__construct(array('ProductItem','Tax')); 
       $this->setAlias(array('slave'=>'slave','master'=>'master'));
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getProductItem();   
	      if (!isset($this->items[$item->get('id')]))
              {	  
                         $item->set('tva_id',$items->hasTax()?$items->getTax():false);  
                         $this->items[$item->get('id')]=$item; 				    
               }
       }
    }
   
    
   
    
    
}

