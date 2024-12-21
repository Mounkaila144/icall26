<?php

class MarketingLeadsWpFormsStatusPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array('MarketingLeadsWpFormsStatusI18n','MarketingLeadsWpFormsStatus'));      
    }        
            
    protected function fetchObjects($db)
    {               
        while ($items = $db->fetchObjects()) 
        {
            
            $item=$items->getMarketingLeadsWpFormsStatus(); 
            $item->setI18n($items->hasMarketingLeadsWpFormsStatusI18n()?$items->getMarketingLeadsWpFormsStatusI18n():null);
            
            $this->items[$item->get('id')]=$item;                            
        }  
//        var_dump($this->items);
    } 
}

