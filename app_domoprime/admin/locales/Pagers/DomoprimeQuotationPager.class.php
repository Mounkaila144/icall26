<?php


class DomoprimeQuotationPager extends Pager {

    
    function __construct()
    {                 
       parent::__construct(array('DomoprimeQuotation','User','Customer','CustomerContract',
                    //             'PartnerPolluterCompany'
                    ));               
    }     
        
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeQuotation();        
              $item->set('creator_id',$items->hasUser()?$items->getUser():0);
              $item->set('contract_id',$items->hasCustomerContract()?$items->getCustomerContract():0);
              $item->set('polluter_id',$items->hasPartnerPolluterCompany()?$items->getPartnerPolluterCompany():false);
              $item->set('customer_id',$items->getCustomer());
              $this->items[$item->get('id')]=$item;                            
       }      
    }
   
  
}

