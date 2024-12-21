<?php

class MarketingLeadsWpFormsBySitePager extends Pager {
    
    function __construct()
    {             
        parent::__construct("MarketingLeadsWpFormsBySite");      
    }        
            
//    protected function fetchObjects($db)
//    {               
//        while ($items = $db->fetchObjects()) 
//        {
//            $item=$items->getServiceImpotIncomeClass(); 
//            $item->setI18n($items->hasServiceImpotIncomeClassI18n()?$items->getServiceImpotIncomeClassI18n():0);
//            
//            $this->items[$item->get('id')]=$item;                            
//        }  
//    } 
}

