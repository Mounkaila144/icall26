<?php


class PartnersPolluterEvents {
    
    
    
       
    static function initializationFormConfig(mfEvent $event)
    {
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('partners_polluter',$form->getSite()))
             return ;     
       //  echo "Meeting ICI Config";
         $form->setValidator('partners_polluter_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {  
          $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('partners_polluter',$form->getSite()))
             return ;      
      //  echo "Meeting ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('partners_polluter_clean'))
        {    
            PartnerPolluterUtils::initializeSite($form->getSite());
        }
    }
    
}
