<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteEditForm.class.php";

class site_ajaxViewAdminSiteAction extends mfAction {

    function execute(mfWebRequest $request) {                 
        $messages = mfMessages::getInstance();
        $this->form = new siteEditForm();
        $this->site=new Site($request->getPostParameter('Site'));  
    }

}

