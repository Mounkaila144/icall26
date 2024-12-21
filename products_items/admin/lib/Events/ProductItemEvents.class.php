<?php

class ProductItemEvents extends ProductItemEventsBase {
     
    static function EmailParametersBuildForInstallerSchedule(mfEvent $event)
    {        
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('products_items'))
             return ;        
         $schedule=$action->getParameter('schedule');              
         if ($schedule)
         {                       
            $action->installations[0]['item']=$schedule->getProductItem()->toArrayForDocument();                     
         }  
         else
         {
             $schedules=$action->getParameter('schedules');    
             if ($schedules)
             {    
                
                 
                 
             }
             return ;
         }    
        
    }
    
    static function copyProductItemsWithLinks(mfEvent $event){        
        $copy=$event->getSubject();
        if(!mfModule::isModuleInstalled('products_items',$copy->getSite()))
            return;
        $products_item=ProductItemUtils::copyItemsFrom($copy,$event['source']);
        ProductItemUtils::copyLinksFrom($products_item,$event['source']);

    }
    
}

