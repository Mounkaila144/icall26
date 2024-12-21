<?php


class DialogListFilterContractsPager extends Pager {

    
    function __construct($classes)
    {             
       parent::__construct($classes);      
       $this->setAlias(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2'));
    }        
            
    protected function fetchObjects($db)
    {       
      //  echo $this->getQuery();
        
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getCustomerContract();    
            //  echo $item->get('id')."<br/>";
              
              if ($items->hasCustomerContractStatus())
              {    
                  $items->getCustomerContractStatus()->setCustomerContractStatusI18n($items->getCustomerContractStatusI18n());
                  $item->set('state_id',$items->getCustomerContractStatus());
              }    
              else
              {
                  $item->set('state_id',0);
              }    
              $item->set('telepro_id',$items->hasTelepro()?$items->getTelepro():null);                           
              $item->set('sale_1_id',$items->hasSale1()?$items->getSale1():null);               
              $item->set('sale_2_id',$items->hasSale2()?$items->getSale2():null);             
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->set('customer_id',$items->getCustomer());
              $this->items[$item->get('id')]=$item;                                               
       }          
    }
   
  
    
}

