<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteCompanyForm.class.php";



class site_ajaxCompanySiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->site=new Site($request->getPostParameter('Site'));
        $this->form = new SiteCompanyForm($request->getPostParameter('Site'));        
    }

}

