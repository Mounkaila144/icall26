<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsImportFormFilter.class.php";

class customers_meetings_imports_ajaxImportStartFromSiteAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);       
        $this->form=$request->getRequestParameter('form_filter');        
     //   var_dump($this->form->getValue('site_id'));
        $this->formFilter=new CustomerMeetingsImportFormFilter($this->user,array('site_id'=>$this->form->getSiteSource(),'range'=>array('creation_at'=>$this->form->getValue('creation_at'))),$this->site);                     
    }
}


