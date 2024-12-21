<?php


class DomoprimeTypeLayerPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'DomoprimeTypeLayer',
           'DomoprimeTypeLayerI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getDomoprimeTypeLayer();                
              $item->setI18n($items->hasDomoprimeTypeLayerI18n()?$items->getDomoprimeTypeLayerI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

