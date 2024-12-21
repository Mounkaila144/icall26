<?php

class MarketingLeadsWpLandingPageSitePager extends Pager {
    
    function __construct()
    {             
        parent::__construct("MarketingLeadsWpLandingPageSite");      
    }        
            
//    protected function fetchObjects($db)
//    {               
//        while ($items = $db->fetchObjects()) 
//        {
//            $item=$items->getServiceImpotIncome(); 
//            $class = $items->getServiceImpotIncomeClass();
//            $class->setI18n($items->hasServiceImpotIncomeClassI18n()?$items->getServiceImpotIncomeClassI18n():0);
//            $item->setClass($class);
//            
//            $this->items[$item->get('id')]=$item;                            
//        }  
//    } 
}

