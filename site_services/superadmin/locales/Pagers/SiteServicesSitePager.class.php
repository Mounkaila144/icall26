<?php


class SiteServicesSitePager extends Pager{
    
    function __construct() {
        parent::__construct(array('SiteservicesSite'));
    }
   
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                
           $this->items[]=$items->getSiteservicesSite();          
       }          
      
    }
}
