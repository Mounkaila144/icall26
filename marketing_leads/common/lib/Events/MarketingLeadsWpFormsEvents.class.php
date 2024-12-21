<?php

class MarketingLeadsWpFormsEvents  {
     
    
    static function initializationFormConfig(mfEvent $event)
    {        
        $form=$event->getSubject();
        if (!mfModule::isModuleInstalled('marketing_leads',$form->getSite()))
            return ;
        $form->setValidator('marketing_leads_clean',new mfValidatorBoolean());         
    }
    
    static function initializationExecute(mfEvent $event)
    {   
        $form=$event->getSubject();
        if (!mfModule::isModuleInstalled('marketing_leads',$form->getSite()))
            return ;   
        
        if ($form->getValue('marketing_leads_clean'))
        {    
            MarketingLeadsWpLandingPageSite::initializeSite($form->getSite());
        }      
    }
    /* NO SITE  */
    static function changeLeadsExportState(mfEvent $event)
    {   
        $form=$event->getSubject();
        if (!mfModule::isModuleInstalled('marketing_leads'))
            return ;   
        
        MarketingLeadsWpFormsUtils::changeState($form);
    }
    
    static function createFormForMeetingTransfer(mfEvent $event)
    {                      
        $lead=$event->getSubject();     
        
        if (!mfModule::isModuleInstalled('marketing_leads',$event->getParameters()->getSite()))
            return ;
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$event->getParameters()->getSite()))
            return ;              
        $lead->createFromLeadForMeeting($event->getParameters())->save();
    }
    
    static function createFormForMeetingTransferMultiple(mfEvent $event)
    {                      
        $leads=$event->getSubject();
        if (!mfModule::isModuleInstalled('marketing_leads',$event->getParameters()->getSite()))
            return ;   
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$event->getParameters()->getSite()))
            return ;         
        // $event->getParameters() : CustomerMeeting
        //create requests for the meetings     
        $requests = $leads->createFromLeadsForMeetings($event->getParameters());
        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent( $requests, 'marketing.leads.multiple.requests.load'));          
        
        $requests->save();
    }
    
    static function createProductsForMeetingTransfer(mfEvent $event)
    {                      
       // $lead=$event->getSubject();             
        if (!mfModule::isModuleInstalled('marketing_leads',$event->getParameters()->getSite()))
            return ;
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','marketing_leads_meeting_default_products'))))
            return ;       
        $meeting=$event->getParameters(); //$event->getParameters() : CustomerMeeting        
        $meeting->createDefaultProducts();
    }
    
    
    static function createProductsForMeetingTransferMultiple(mfEvent $event)
    {                      
       // $lead=$event->getSubject();             
        if (!mfModule::isModuleInstalled('marketing_leads',$event->getParameters()->getSite()))
            return ;
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','marketing_leads_meeting_multiple_default_products'))))
            return ;       
        $meetings=$event->getParameters(); //$event->getParameters() : CustomerMeeting        
        $meetings->createDefaultProducts();
    }
}
