<?php


class SiteOversightMessagePager extends Pager {
    
    
    function __construct()
    {             
        parent::__construct(array('SiteOversightMessage','User'));
    } 
    
    protected function fetchObjects($db)
    {              
        
        while ($items = $db->fetchObjects()) 
        {                 
            $item=$items->getSiteOversightMessage();    
            $item->set('user_id',$items->hasUser()?$items->getUser():false);
            $this->items[$item->get('id')]=$item;                            
        }         
        
    }
    
   
              
}

