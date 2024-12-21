<?php


class SiteTextPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'SiteText',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getSiteText();                            
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

