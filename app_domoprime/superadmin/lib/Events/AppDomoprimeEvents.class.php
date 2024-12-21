<?php



class AppDomoprimeEvents  {
     
      static function initializationFormConfig(mfEvent $event)
    {
         $form=$event->getSubject();           
         if (!mfModule::isModuleInstalled('app_domoprime',$form->getSite()))
             return ;               
         $form->setValidator('app_domoprime_clean',new mfValidatorBoolean());         
         $form->setValidator('app_domoprime_polluters_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {                       
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime',$form->getSite()))
             return ;                      
         DomoprimeUtils::initializeSite($form);            
        
    }
}

