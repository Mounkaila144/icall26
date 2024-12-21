<?php


class DomoprimeClassPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeClass','DomoprimeClassI18n'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeClass();  
              $item->setI18n($items->hasDomoprimeClassI18n()?$items->getDomoprimeClassI18n():0);
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

