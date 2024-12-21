<?php


class DomoprimeAssetPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeAsset','Customer'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeAsset();                   
              $item->set('customer_id',$items->getCustomer());   
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

