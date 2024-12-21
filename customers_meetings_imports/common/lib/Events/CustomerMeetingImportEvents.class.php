<?php

class CustomerMeetingImportEvents  {
     
    
     static function initializationFormConfig(mfEvent $event)
    {
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_imports',$form->getSite()))
             return ;   
         //echo "Meeting ICI Config";
         $form->setValidator('meetings_import_clean',new mfValidatorBoolean());         
    }
    
     static function initializationExecute(mfEvent $event)
    {   
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_imports',$form->getSite()))
             return ;   
       // echo "Meeting Import ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
       if ($form->getValue('meetings_import_clean'))
        {    
            CustomerMeetingImportFile::initializeSite($form->getSite());
        }      
    }
    
}
