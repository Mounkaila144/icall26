<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteTextViewForm.class.php";

class site_text_ajaxViewTextAction extends mfAction {
                       
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
          $this->user=$this->getUser();
         $this->form= new SiteTextViewForm($this->getUser(),$request->getPostParameter('SiteText'));
        $this->item=new SiteText($request->getPostParameter('SiteText'));         
    }

}
