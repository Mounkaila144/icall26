<?php


class CustomerMeetingImportFilePager extends Pager {
    
    
    function __construct()
    {             
        parent::__construct(array('CustomerMeetingImportFile','User'));        //array('CustomerMeetingImportFile')
    } 
    
    protected function fetchObjects($db)
    {              
        
        while ($items = $db->fetchObjects()) 
        {                 
            $item=$items->getCustomerMeetingImportFile(); 
            $item->setUserObj($items->getUser());
            $this->items[$item->get('id')]=$item;                            
        }         
        
//        echo '<pre>'; var_dump($this->items); echo '</pre>';
//        die(__METHOD__);
    }
    
   
              
}

