<?php


class DomoprimeBillingPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeBilling','Customer',
            'CustomerContractStatus',
                            'CustomerContractStatusI18n',
                                 'CustomerContract'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeBilling();                   
              $item->set('customer_id',$items->getCustomer());   
              $item->set('contract_id',$items->getCustomerContract());  
              if ($items->hasCustomerContractStatus())
              {    
                  $items->getCustomerContractStatus()->setCustomerContractStatusI18n($items->getCustomerContractStatusI18n());
                  $item->getContract()->set('state_id',$items->getCustomerContractStatus());
              }    
              else
              {
                  $item->getContract()->set('state_id',0);
              }  
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

