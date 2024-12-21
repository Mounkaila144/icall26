<?php


class CustomerMeetingDocumentFormPager extends Pager {

    
    function __construct() {
        parent::__construct(array('CustomerMeetingFormDocument','ProductModel','DomoprimeClass','DomoprimeClassI18n'));
    }
          
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                         
              //  $items->getProductModel()->set('model_i18n',$items->getProductModelI18n());
              //  $items->getProductModelProduct()->set('model_id',$items->getProductModel());      
               $item=$items->getCustomerMeetingFormDocument();
               $item->set('model_id',$items->getProductModel());
               if ($items->hasDomoprimeClass())
               {    
                   $item->classe=$items->getDomoprimeClass();
                   $item->classe->setI18n($items->hasDomoprimeClassI18n()?$items->getDomoprimeClassI18n():0);
               }   
               $this->items[]=$item;  
       }    
    }
   
    
}

