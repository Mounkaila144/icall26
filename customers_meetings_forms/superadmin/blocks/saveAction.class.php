<?php



class customers_meetings_forms_saveActionComponent extends mfActionComponent {

     const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {                
        if (!mfModule::isModuleInstalled($this->getModuleName(),$this->getUser()->getStorage()->read(self::SITE_NAMESPACE)))
            return mfView::NONE;
    } 
    
    
}