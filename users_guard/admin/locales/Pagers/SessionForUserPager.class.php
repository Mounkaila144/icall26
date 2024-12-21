<?php


class SessionForUserPager extends Pager {
    
   function __construct() {        
        parent::__construct(array("Session"));            
    }
    
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getSession();                                                                       
              $this->items[$item->get('session')]=$item;                            
       }              
    }
}