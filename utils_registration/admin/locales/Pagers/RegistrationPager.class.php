<?php


class RegistrationPager extends Pager {
    
        function __construct() {
        parent::__construct(array(
                                  'UtilsRegistration'
                                 ));
    }
   
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {     
           $item=$items->getUtilsRegistration();                 
           $this->items[]=$item;                  
       }          
      
    }
    
}
