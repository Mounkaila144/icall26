<?php


class SystemMenuPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'SystemMenu',
           'SystemMenuI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {              
         // echo "<pre>"; var_dump($items);echo "</pre>"; 
              $item=$items->getSystemMenu();                
              $item->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():0);              
              $this->items[$item->get('id')]=$item;   
             // $item->setManager("souad");   
              
       }                 
    }
   
    
}

