<?php


class CustomerMeetingDocumentFieldForDocumentPager extends Pager {

    
    function __construct() {
        parent::__construct(array('CustomerMeetingFormDocumentFormfield',
                                  'CustomerMeetingFormfield',
                                  'CustomerMeetingFormfieldI18n',
                                 // 'CustomerMeetingFormDocumentFormfield',                                        
                                //  'DomoprimeClass', 'DomoprimeClassI18n',            
                            ));
    }
          
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                                         
               $item=$items->getCustomerMeetingFormDocumentFormfield();
               $item->set('formfield_id',$items->getCustomerMeetingFormfield());
               $item->getFormField()->setI18n($items->getCustomerMeetingFormfieldI18n());
           /*    if ($items->hasDomoprimeClass())
               {    
                   $item->classe=$items->getDomoprimeClass();
                   $item->classe->setI18n($items->hasDomoprimeClassI18n()?$items->getDomoprimeClassI18n():0);
               }    */              
               $this->items[]=$item;  
       }    
     /*  echo "<pre>";
       foreach ($this->items as $item)
       {
           if ($item->hasClasse())
           {    
           // var_dump($item->getClasse());
           } 
       }    
         echo "</pre>"; */
    }
   
    
}
