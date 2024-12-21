<?php


class MarketingLeadsWpFormsLeadsImportFilePager extends Pager {
    
    
    function __construct()
    {             
        parent::__construct(array('MarketingLeadsWpFormsLeadsImportFile','User'));        //array('CustomerContractImportFile')
    } 
    
    protected function fetchObjects($db)
    {              
        
        while ($items = $db->fetchObjects()) 
        {                 
            $item=$items->getMarketingLeadsWpFormsLeadsImportFile(); 
            $item->setUserObj($items->getUser());
            $this->items[$item->get('id')]=$item;                            
        }         
        
//        echo '<pre>'; var_dump($this->items); echo '</pre>';
//        die(__METHOD__);
    }
    
   
              
}

