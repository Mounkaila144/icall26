<?php


class PartnerLayerCompanyPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('PartnerLayerCompany'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getPartnerLayerCompany();                  
              $this->items[$item->get('id')]=$item;                            
       }    
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'partners.layer.pager'));   
    }
   
}
