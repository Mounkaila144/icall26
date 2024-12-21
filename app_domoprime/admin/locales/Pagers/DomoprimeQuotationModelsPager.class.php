<?php


class DomoprimeQuotationModelsPager extends Pager {
    
    function __construct()
    {               
       parent::__construct(array('DomoprimeQuotationModelI18n','DomoprimeQuotationModel'/*,'DomoprimePolluterQuotation','PartnerPolluterCompany'*/));            
    }        
            
    protected function fetchObjects($db)
    {        
       while ($items = $db->fetchObjects()) 
       {                                       
                $item=$items->getDomoprimeQuotationModel();  
                $item->setI18n($items->hasDomoprimeQuotationModelI18n()?$items->getDomoprimeQuotationModelI18n():0);
                $this->items[$item->get('id')]=$item;              
       }
        DomoprimeQuotationModelUtils::getPollutersFromPager($this);
    }
    
}
