<?php


class SitesPager extends Pager {
    
    function __construct() {
        parent::__construct(array('Site'));     
        
    }
    
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {       
           $item=$items->getSite(); 
           $this->items[]=$item;          
       }          
      
    }
}
