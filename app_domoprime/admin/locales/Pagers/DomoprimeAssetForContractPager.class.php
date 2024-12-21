<?php


class DomoprimeAssetForContractPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeAsset'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeAsset();                   
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

