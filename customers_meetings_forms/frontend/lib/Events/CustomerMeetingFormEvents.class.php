<?php



class CustomerMeetingFormEvents  {
     
    
    
    static function setFormConfigForContract(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
        $form=$event->getSubject();  // CustomerContractSlaveNewForm        
        $form->setValidator('forms',new mfValidatorString(array('required'=>false)));
    }
    
    
    static function setFormForContract(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
       $form=$event->getSubject();  // CustomerContractSlaveNewForm 
       $forms=new CustomerMeetingForms($form->getContract());
       if ($forms->isLoaded())
           return ;      
       $forms->set('data',$form['forms']->getValue());
       $forms->save();          
       mfContext::getInstance()->getEventManager()->notify(new mfEvent( $forms, 'contract.slave.forms',array('form'=>$form)));     
    }
    
    
     static function setFormConfigForMeeting(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
        $form=$event->getSubject();  // CustomerMeetingSlaveNewForm        
        $form->setValidator('forms',new mfValidatorString(array('required'=>false)));
    }
    
    
    static function setFormForMeeting(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
       $form=$event->getSubject();  // CustomerMeetingSlaveNewForm 
       $forms=new CustomerMeetingForms($form->getMeeting());
       if ($forms->isLoaded())
           return ;      
       $forms->set('data',$form['forms']->getValue());
       $forms->save();          
       mfContext::getInstance()->getEventManager()->notify(new mfEvent( $forms, 'meeting.slave.forms',array('form'=>$form)));     
    }
    
    
    static function getDataForContractMasterTransfer(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
       $answers=$event->getSubject();  // mfArray      
       $forms=new CustomerMeetingForms($answers->getContract());
       if ($forms->isNotLoaded())
           return ;      
       $answers->set('forms',$forms->get('data'));         
    }
    
    static function getDataForMeetingMasterTransfer(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
       $answers=$event->getSubject();  // mfArray      
       $forms=new CustomerMeetingForms($event['meeting']);
       if ($forms->isNotLoaded())
           return ;      
       $answers->set('forms',$forms->get('data'));         
    }
}
