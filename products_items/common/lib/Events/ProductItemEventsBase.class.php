<?php

class ProductItemEventsBase  {
     
   
     
    
    static function initializationExecute(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('products_items'))
             return ;
         $form=$event->getSubject();
        // echo "Meeting forms ICI Execute";
        // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('products_clean'))
        {    
            ProductItem::initializeSite($form->getSite());
        }        
    }
    
    
}
