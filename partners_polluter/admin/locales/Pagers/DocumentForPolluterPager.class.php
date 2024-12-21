<?php


class DocumentForPolluterPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('CustomerMeetingFormDocument','PartnerPolluterDocument',
                                 'PartnerPolluterModel',
                               'PartnerPolluterModelI18n'
                    ));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
         //    echo "<pre>";  var_dump($items); echo "</pre>"; 
              if ($items->hasPartnerPolluterDocument())
              {    
                  $item=$items->getPartnerPolluterDocument();
                  $this->items[$items->getCustomerMeetingFormDocument()->get('id')]=$item;        
              }
              else
              {
                  $item=new PartnerPolluterDocument(null,$this->getSite());
                  $this->items[$items->getCustomerMeetingFormDocument()->get('id')]=$item;
              }         
             if ($items->hasPartnerPolluterModel())
             {                     
                $item->set('model_id',$items->getPartnerPolluterModel()) ;                
                $item->getModel()->setI18n($items->hasPartnerPolluterModelI18n()?$items->getPartnerPolluterModelI18n():0);  
             }   
             $item->set('document_id',$items->getCustomerMeetingFormDocument());
       }         
    }
   
}
