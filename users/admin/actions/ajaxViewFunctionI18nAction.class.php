<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionViewForm.class.php";
 
class users_ajaxViewFunctionI18nAction extends mfAction {
    
    
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();
        $this->form = new UserFunctionViewForm();
        $this->item=new UserFunctionI18n($request->getPostParameter('UserFunctionI18n'));        
   }

}

