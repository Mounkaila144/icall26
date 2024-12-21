<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportFromSiteForm.class.php";

class customers_meetings_imports_ajaxImportFromSiteAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->form=new CustomerMeetingImportFromSiteForm($this->user);   
       //    var_dump($this->form->site_id->getOption('choices'));
     //   var_dump((string)$this->form['creation_at']['from']);
        if ($request->isMethod('POST') && !$request->getPostParameter('CustomerMeetingImportFromSite'))
            return ;
        $this->form->bind($request->getPostParameter('CustomerMeetingImportFromSite'));        
        if ($this->form->isValid())
        {
            // $messages->addInfo(__("Import will start."));
             $request->addRequestParameter('form_filter',$this->form);
             $this->forward('customers_meetings_imports','ajaxImportStartFromSite');
        }   
        else
        {
            $messages->addError(__("Form has some errors"));
           //    echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";  
        }         
    }
}


