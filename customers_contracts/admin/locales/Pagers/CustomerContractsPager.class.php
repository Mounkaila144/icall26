<?php


class CustomerContractsPager extends Pager {

  
   /* function __construct(mfArray $classes,mfArray $alias)
    {               
       parent::__construct($classes->toArray());      
       $this->setAlias($alias);  
    }    */   
    
    function __construct($filter)
    {               
       $this->filter=$filter;
       parent::__construct($filter->getObjectsForPager()->toArray());      
       $this->setAlias($filter->getAlias());  
    } 
            
    protected function fetchObjects($db)
    {        
       $index=0;
       while ($items = $db->fetchObjects()) 
       {         
           $index++;
          // var_dump($items);
              $item=$items->getCustomerContract();            
              if (isset($this->items[$item->get('id')]))
                  continue;
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
              if ($items->hasCustomerContractTimeStatus())
              {                      
                  $items->getCustomerContractTimeStatus()->setI18n($items->getCustomerContractTimeStatusI18n());
                  $item->set('time_state_id',$items->getCustomerContractTimeStatus());
              }    
              else
              {
                  $item->set('time_state_id',false);
              }   
              if ($items->hasCustomerContractAdminStatus())
              {                      
                  $items->getCustomerContractAdminStatus()->setI18n($items->getCustomerContractAdminStatusI18n());
                  $item->set('admin_status_id',$items->getCustomerContractAdminStatus());
              }    
              else
              {
                  $item->set('admin_status_id',false);
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
              mfContext::getInstance()->getEventManager()->notify(new mfEvent($items, 'contracts.list.pager.item',array('item'=>$item)));                                            
              $this->items[$item->get('id')]=$item;                                     
       }                    
       SystemDebug::getInstance()->addMessage($db->getQuery()); 
       SystemDebug::getInstance()->addMessage("Index=".$index); 
       CustomerContractUtils::getProductsFromPager($this);
       CustomerContractUtils::getCommentsFromPager($this);       
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contracts.list.pager'));         
    }
   
    function getTurnover()
    {
        if (!$this->isExecuted())
            return null;
       return CustomerContractUtils::getTurnoverFromPager(array_keys($this->items));
    }
    
    function getTurnoverWithoutTaxFromPager()
    {
        if (!$this->isExecuted())
            return null;
       return CustomerContractUtils::getTurnoverWithoutTaxFromPager(array_keys($this->items));
    }
    
    function getTaxAmountFromPager()
    {
        if (!$this->isExecuted())
            return null;
       return CustomerContractUtils:: getTaxAmountFromPager(array_keys($this->items));
    }
    
        
    function getNumberOfActiveIsDocument()
    {
       return CustomerContractUtils::getNumberOfActiveIsDocument($this); 
    }
    
    function getNumberOfNoActiveIsDocument()
    {
      return CustomerContractUtils::getNumberOfNoActiveIsDocument($this);  
    }
    
     function getNumberOfActiveIsQuality()
    {
       return CustomerContractUtils::getNumberOfActiveIsQuality($this); 
    }
    
    function getNumberOfNoActiveIsQuality()
    {
      return CustomerContractUtils::getNumberOfNoActiveIsQuality($this);  
    }
    
     function getNumberOfActiveIsPhoto()
    {
       return CustomerContractUtils::getNumberOfActiveIsPhoto($this); 
    }
    
    function getNumberOfNoActiveIsPhoto()
    {
      return CustomerContractUtils::getNumberOfNoActiveIsPhoto($this);  
    }
    
     function getFilter()
    {
        return $this->filter;
    }
}

