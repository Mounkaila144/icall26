<?php


class CustomerContractPager2 extends Pager {

  
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
     //  $index=0;
       while ($items = $db->fetchObjects()) 
       {         
       //    $index++;
         //  echo "idx=".$index."<br>";
          // var_dump($items);
              $item=$items->getCustomerContract();      
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->set('customer_id',$items->getCustomer());     
            //  if (isset($this->items[$item->get('id')]))
            //      continue;
           
              
            /*
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
              $item->set('tax_id',$items->hasTax()?$items->getTax():null);*/
        //      mfContext::getInstance()->getEventManager()->notify(new mfEvent($items, 'contracts.list.pager.item',array('item'=>$item)));                                            
              $this->items[$item->get('id')]=$item;                                     
       }                    
     //  SystemDebug::getInstance()->addMessage($db->getQuery()); 
    //   SystemDebug::getInstance()->addMessage("Index=".$index); 
        CustomerContractUtils::getProductsFromPager($this);
        CustomerContractUtils::getStatesFromPager($this);
        CustomerContractUtils::getUsersByFieldFromPager('created_by_id',$this);
        CustomerContractUtils::getUsersByFieldFromPager('telepro_id',$this);
        CustomerContractUtils::getUsersByFieldFromPager('sale_1_id',$this);
        CustomerContractUtils::getUsersByFieldFromPager('sale_2_id',$this);
        CustomerContractUtils::getUsersByFieldFromPager('assistant_id',$this);
        CustomerContractUtils::getTeamsFromPager($this);
        CustomerContractUtils::getStatesFromPager($this);
        CustomerContractUtils::getInstallStatesFromPager($this);
        CustomerContractUtils::getRangesFromPager($this);
        CustomerContractUtils::getPollutersFromPager($this);
        CustomerContractUtils::getFinancialsFromPager($this);
     //   CustomerContractUtils::getLayersFromPager($this);
        CustomerContractUtils::getCompaniesFromPager($this);
        CustomerContractUtils::getOpcStatesFromPager($this);
        CustomerContractUtils::getCommentsFromPager($this);      
        
        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contracts.list.pager2'));         
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
    
    function getUser()
    {
        return $this->getFilter()->getUser();
    }
    
    function getKeys()
    {
        return new mfArray(parent::getKeys());
    }
}

