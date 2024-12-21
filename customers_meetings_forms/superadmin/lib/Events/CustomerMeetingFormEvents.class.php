<?php

class CustomerMeetingFormEvents  {
     
    static function setForm(mfEvent $event)
    {                  
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms', $form->getSite()))
             return ;
         require_once dirname(__FILE__)."/../../locales/Forms/CustomerMeetingNewForms.class.php";         
         $form->embedForm('extra', new CustomerMeetingNewForms($form->getDefault('extra'),$form->getSite()));        
    }
    
    static function meetingChange(mfEvent $event)
    {      
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings_forms', $meeting->getSite()) || !isset($event['form']))
             return ;         
        $form=new CustomerMeetingForms(null,$meeting->getSite());
        $form->set('meeting_id',$meeting);                     
        $form->setData($event['form']['extra']->getValues(),$event['form']->getEmbeddedForm('extra')->getParameters()); 
        $form->save();
    }
    
     static function EmailParametersBuildForMeeting(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         $meeting=$action->getParameter('meeting');
         $forms=new CustomerMeetingForms($meeting,$meeting->getSite());        
         $action->meeting['forms']=$forms->getData();        
    }
    
    static function SmsParametersBuildForMeeting(mfEvent $event)
    {
        self::EmailParametersBuildForMeeting($event);
    }
    
    static function EmailParametersBuildForContract(mfEvent $event)
    {
        $action=$event->getSubject();
        $contract=$action->getParameter('contract');  
         if (!mfModule::isModuleInstalled('customers_meetings_forms',$contract->getSite()))
             return ;                
         if ($contract->getMeeting()->isNotLoaded())
             return ;
         $forms=new CustomerMeetingForms($contract->getMeeting(),$contract->getSite());        
         $action->meeting['forms']=$forms->getData();        
    }
    
    static function SmsParametersBuildForContract(mfEvent $event)
    {
        self::EmailParametersBuildForContract($event);
    }
    
     static function DocumentParametersBuild(mfEvent $event)
    {
         $action=$event->getSubject();
         $meeting=$action->getParameter('meeting');   
         if (!mfModule::isModuleInstalled('customers_meetings_forms',$meeting->getSite()))
             return ;                
         if ($meeting->isNotLoaded())
             return ;         
         $forms=new CustomerMeetingForms($meeting,$meeting->getSite());        
         $action->meeting['forms']=$forms->getDataI18n();    
    }
    
    
     static function importMeetings(mfEvent $event)
    {         
        $meetings=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings_forms', $meetings->getSite()))
             return ;      
        $dst_meetings=$meetings->getDestinationCollection();
        if (!$dst_meetings || $dst_meetings->isEmpty())
            return ;
        $collection=new CustomerMeetingFormsCollection(null,$meetings->getDestinationCollection()->getSite());
        // get forms for all meetings
        $forms=CustomerMeetingForms::getFormsByMeetings($meetings);
        foreach ($forms as $src_form)
        {
            $dst_form=new CustomerMeetingForms(null,$meetings->getDestinationCollection()->getSite());
            $dst_form->copyFrom($src_form);
            $dst_form->set('meeting_id',$dst_meetings[$src_form->get('meeting_id')]->get('id'));
            $collection[]=$dst_form;
        }    
        $collection->save();       
    }
    
    
     static function initializationFormConfig(mfEvent $event)
    {
           $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms',$form->getSite()))
             return ;   
       //  echo "Meeting ICI Config";
         $form->setValidator('meetings_form_clean',new mfValidatorBoolean());
         $form->setValidator('meetings_form_scoring_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {      
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms',$form->getSite()))
             return ;   
       // echo "Meeting forms ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('meetings_form_clean'))
        {    
            CustomerMeetingFormUtils::initializeSite($form->getSite());
        }
        if ($form->getValue('meetings_form_scoring_clean'))
        {    
            CustomerMeetingForms::initializeSite($form->getSite());
        }
    }
    
}
