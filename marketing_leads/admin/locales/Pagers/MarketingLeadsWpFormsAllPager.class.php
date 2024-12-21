<?php

class MarketingLeadsWpFormsAllPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array("MarketingLeadsWpForms","MarketingLeadsWpLandingPageSite","MarketingLeadsWpFormsStatus","MarketingLeadsWpFormsStatusI18n"));      
    }        
            
    protected function fetchObjects($db)
    {               
        while ($items = $db->fetchObjects()) 
        {
            $item=$items->getMarketingLeadsWpForms(); 
            $item->setSite($items->getMarketingLeadsWpLandingPageSite());
            if($items->hasMarketingLeadsWpFormsStatus())
            {
                $status = $items->getMarketingLeadsWpFormsStatus();
                $status->setI18n($items->hasMarketingLeadsWpFormsStatusI18n()?$items->getMarketingLeadsWpFormsStatusI18n():null);
                $item->setStatus($status);
            }
            $this->items[$item->get('id')]=$item;                            
        }  
    } 
}

