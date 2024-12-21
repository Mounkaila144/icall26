<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportViewFormatForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/MarketingLeadsWpFormsAllLeadsImport.class.php";

class marketing_leads_ajaxViewFormatAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();            
        $this->format=new MarketingLeadsWpFormsLeadsImportFormat($request->getPostParameter('WpFormsLeadsImportFormat'));      
        if ($this->format->isNotLoaded())
        {
            $messages->addError(__('Format is invalid'));
            $this->forward('marketing_leads','ajaxListPartialFormat');
        }        
        $this->form=new MarketingLeadsWpFormsLeadsImportViewFormatForm($this->getUser(),array('fields'=>$this->format->getNamesValues()));          
    }
}


