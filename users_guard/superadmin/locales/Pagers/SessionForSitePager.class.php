<?php

class SessionForSitePager extends Pager{
  
    function __construct() {        
        parent::__construct(array("Session","User"));            
    }
    
    protected function fetchObjects($db)
    {                
        while ($items = $db->fetchObjects()) 
        {                                  
            $item=$items->getSession();    
            $item->set('user_id',$items->getUser());
            $this->items[$item->get('id')]=$item;                            
        }              
    }
}
