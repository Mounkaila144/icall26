<?php

class PartnerEvents {
     
 
   
     static function initializationExecute(mfEvent $event)
    {       
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('partners',$form->getSite()))
             return ;
        //echo "Contract ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('contracts_clean'))
        {    
            PartnerUtils::initializeSite($form->getSite());
        }
    }
    
}

