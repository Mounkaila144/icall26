<?php


class UserValidationTokenPager extends Pager {
    
   function __construct() {        
        parent::__construct(array("UserValidationToken","User"));         
    }
    
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getUserValidationToken();                
              $item->set('user_id',$items->getUser());         
              $this->items[$item->get('id')]=$item;                            
       }          
    }
}
