<?php


class SiteServicesServerPager extends Pager {
   
    function __construct() {
        parent::__construct(array('SiteServicesServer'));
    }
   
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                
           $this->items[]=$items->getSiteServicesServer();          
       }          
      
    }
   
}
