<?php



class CustomerEvents  {
     
    static function setViewContractForm(mfEvent $event)
    {                  
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers'))
             return ;  
         if ($form->getContract()->isHold())
             return ;
         if (!mfContext::getInstance()->getUser()->hasCredential([['superadmin_debugX','contract_view_customer']]))
            return ;
         require_once dirname(__FILE__)."/../../../admin/locales/Forms/CustomerModifyForm.class.php";           
         $form->mergeForm(new CustomerModifyForm(mfContext::getInstance()->getUser(),array('customer'=>$form->getDefault('customer'),'address'=>$form->getDefault('address'))));        
    }
   
    
    static function setContractChange(mfEvent $event)
    {                  
         $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers'))
             return ;   
         if (!mfContext::getInstance()->getUser()->hasCredential([['superadmin_debugX','contract_view_customer']]))
            return ;
         if ($event['action']=='populate' && $event['form'] instanceof mfForm)
         {
             if ($event['form']->getContract()->isHold())
                    return ;
             $contract->getCustomer()->add($event['form']->getDefault('customer'));
             $contract->getCustomer()->getAddress()->add($event['form']->getDefault('address'));
         }    
         
         if ($event['action']=='update' && $event['form'] instanceof mfForm)
         {
             if ($event['form']->getContract()->isHold())
                    return ;
             $contract->getCustomer()->add($event['form']->getValue('customer'))->save();
             $contract->getCustomer()->getAddress()->add($event['form']->getValue('address'))->save();
         } 
    }
    
    static function setDataNewContractFormApi(mfEvent $event)
    {                   
        
         if (!mfModule::isModuleInstalled('customers'))
             return ;  

         $event->getSubject()->getData()->add(array('customer'=>new mfArray(
            array(                             
                     'lastname'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),                                
                     'firstname'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),                                
                     'phone'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),             
                     'mobile'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),             
                     'mobile0'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),             
                     'email'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),             
                     'gender'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),             
        ))))->set('address',new mfArray(
                array(
                    'address1'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),
                    'address2'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),
                    'postcode'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),
                    'city'=>array(
                         'style'=>array(
                             'parameters'=>array(
                                 'true'=>'content:fa-check;color:#00ff00',
                                 'false'=>'content:fa-uncheck;color:#ff0000',                                    
                     ))),
                ))); 
               
       // echo "<pre>"; var_dump($event->getSubject()->getData()->toArray());
    }
   
}
