<?php


class PartnersLayerEvents {
    
       
    static function initializationFormConfig(mfEvent $event)
    {        
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('partners_layer',$form->getSite()))
             return ;              
         $form->setValidator('partners_layer_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {  
          $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('partners_layer',$form->getSite()))
             return ;      
      //  echo "Meeting ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('partners_layer_clean'))
        {    
            PartnerLayerUtils::initializeSite($form->getSite());
        }
    }
}
