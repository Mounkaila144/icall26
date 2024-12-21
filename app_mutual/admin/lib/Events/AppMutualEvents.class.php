<?php

require_once dirname(__FILE__).'/../../locales/Forms/MutualProductsForMeeting/MutualProductForNewMeetingForm.class.php';

class AppMutualEvents  {
    
    /* NO SITE */
    static function MeetingNewForm(mfEvent $event)
    {        
        $form=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_mutual',mfContext::getInstance()->getSite()->getSite()))
            return ; 
        
        ///Ajouter le formulaire des produits mutual
        $form->embedForm("mutual",new MutualProductForNewMeetingForm($form->getDefault('mutual')));
    }
    
    static function MeetingChange(mfEvent $event)
    {                         
        $meeting=$event->getSubject();        
        if (!mfModule::isModuleInstalled('app_mutual') || !isset($event['form']))
            return ;         
        if (!$event['form']->hasValidator('mutual')) // check if validator exists.
            return ;
               
        if ($event['form']->isValid())
        {
            $event['form']->getEmbeddedForm('mutual')->getCollection($event['form']['mutual']->getValue('collection'),$meeting)->save();                     
        }  
    }
}
