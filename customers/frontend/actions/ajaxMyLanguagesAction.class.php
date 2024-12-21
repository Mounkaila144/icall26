<?php

require_once dirname(__FILE__)."/../locales/Forms/MyLanguagesForm.class.php";

class customers_ajaxMyLanguagesAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();       
        $this->form=new MyLanguagesForm($this->user);
    }
    
}