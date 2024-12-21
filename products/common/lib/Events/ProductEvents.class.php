<?php

class ProductEvents  {
     
   
     static function initializationFormConfig(mfEvent $event)
    {
          if (!mfModule::isModuleInstalled('products'))
             return ;
         $form=$event->getSubject();
       //  echo "Meeting ICI Config";
         $form->setValidator('products_clean',new mfValidatorBoolean());         
    }
    
     static function initializationExecute(mfEvent $event)
    {
           if (!mfModule::isModuleInstalled('products'))
             return ;
         $form=$event->getSubject();
       // echo "Meeting forms ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('products_clean'))
        {    
            ProductUtils::initializeSite($form->getSite());
        }        
    }
    
}
