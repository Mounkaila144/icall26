<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteCompanyForm.class.php";

class site_company_ajaxViewAction extends mfAction {
    

    function execute(mfWebRequest $request) 
    {             
        $messages = mfMessages::getInstance();
      
        $this->site_company=SiteCompanyUtils::getSiteCompany();      
        $this->form=new SiteCompanyForm(array('country'=>'FR'));
        
    }

}


