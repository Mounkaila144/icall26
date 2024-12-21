<?php


class customers_meetings_forms_variablesEmailTabActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    
    function execute(mfWebRequest $request)
    {
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->variables=new CustomerMeetingFormsModelEmailVariables($site);  
    } 
    
    
}

