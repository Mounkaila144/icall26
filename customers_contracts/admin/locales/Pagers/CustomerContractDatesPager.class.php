<?php


class CustomerContractDatesPager extends Pager {


    function __construct(mfArray $classes)
    {                 
       parent::__construct($classes->toArray());      
       $this->setAlias(array('telepro'=>'telepro',
                             'sale1'=>'sale1','sale2'=>'sale2',
                             'creator'=>'creator',
                             'assistant'=>'assistant'));
    }        
            
    protected function fetchObjects($db)
    {                     
       while ($items = $db->fetchObjects()) 
       {                        
          // var_dump($items);
              $item=$items->getCustomerContract();                
              if ($items->hasCustomerContractStatus())
              {    
                  $items->getCustomerContractStatus()->setCustomerContractStatusI18n($items->getCustomerContractStatusI18n());
                  $item->set('state_id',$items->getCustomerContractStatus());
              }    
              else
              {
                  $item->set('state_id',0);
              }  
              if ($items->hasCustomerContractInstallStatus())
              {    
                  $items->getCustomerContractInstallStatus()->setI18n($items->hasCustomerContractInstallStatusI18n()?$items->getCustomerContractInstallStatusI18n():0);
                  $item->set('install_state_id',$items->getCustomerContractInstallStatus());
              }    
              else
              {
                  $item->set('install_state_id',0);
              }  
               if ($items->hasCustomerContractRange())
              {    
                  $items->getCustomerContractRange()->setI18n($items->getCustomerContractRangeI18n());
                  $item->set('opc_range_id',$items->getCustomerContractRange());
              }    
              else
              {
                  $item->set('opc_range_id',0);
              }  
              if ($items->hasCustomerContractOpcStatus())
              {    
                  $items->getCustomerContractOpcStatus()->setI18n($items->getCustomerContractOpcStatusI18n());
                  $item->set('opc_status_id',$items->getCustomerContractOpcStatus());
              }    
              else
              {
                  $item->set('opc_status_id',false);
              } 
              $item->set('created_by_id',$items->hasCreator()?$items->getCreator():0);    
              $item->set('telepro_id',$items->hasTelepro()?$items->getTelepro():0);                 
              $item->set('sale_1_id',$items->hasSale1()?$items->getSale1():0);               
              $item->set('sale_2_id',$items->hasSale2()?$items->getSale2():0); 
              $item->set('assistant_id',$items->hasAssistant()?$items->getAssistant():0); 
              $item->set('financial_partner_id',$items->hasPartner()?$items->getPartner():0);              
              $item->set('partner_layer_id',$items->hasPartnerLayerCompany()?$items->getPartnerLayerCompany():0);     
              $item->set('team_id',$items->hasUserTeam()?$items->getUserTeam():0);
              $item->set('polluter_id',$items->hasPartnerPolluterCompany()?$items->getPartnerPolluterCompany():0);
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->set('customer_id',$items->getCustomer());              
              $item->set('tax_id',$items->hasTax()?$items->getTax():null);              
              $this->items[$item->get('id')]=$item;                                     
       }                          
    }
   
    
}

