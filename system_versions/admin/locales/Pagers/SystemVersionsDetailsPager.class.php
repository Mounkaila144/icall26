<?php

class SystemVersionsDetailsPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array('SystemVersionsFile','ModuleManager'));
    } 
    
    protected function fetchObjects($db)
    {              
        
        while ($items = $db->fetchObjects()) 
        {                 
            $item=$items->getSystemVersionsFile(); 
//            $item->setUserObj($items->getUser());
            $this->items[$item->get('id')]=$item;                            
        }         
        
//        echo '<pre>'; var_dump($this->items); echo '</pre>';
//        die(__METHOD__);
    }
}
