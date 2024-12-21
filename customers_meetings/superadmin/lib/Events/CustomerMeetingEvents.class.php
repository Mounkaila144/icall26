<?php

class CustomerMeetingEvents {
        
   
    static function initializationFormConfig(mfEvent $event)
    {
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$form->getSite()))
             return ;     
       //  echo "Meeting ICI Config";
         $form->setValidator('meetings_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {  
          $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$form->getSite()))
             return ;      
      //  echo "Meeting ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('meetings_clean'))
        {    
            CustomerMeetingUtils::initializeSite($form->getSite());
        }
    }
}

