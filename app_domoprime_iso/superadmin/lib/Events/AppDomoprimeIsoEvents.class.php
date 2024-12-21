<?php



class AppDomoprimeIsoEvents  {
     
      
    
     static function initializationExecute(mfEvent $event)
    {                       
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso',$form->getSite()))
             return ;                      
         
    }
}

