<?php


 require_once dirname(__FILE__)."/../locales/Forms/UserAttributionViewForm.class.php";
 
class  users_ajaxViewAttributionI18nAction extends mfAction {
    
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                  
        $messages = mfMessages::getInstance();     
        $this->form = new UserAttributionViewForm();                                     
        $this->item=new UserAttributionI18n($request->getPostParameter('UserAttributionI18n'));                                                             
   }

}

