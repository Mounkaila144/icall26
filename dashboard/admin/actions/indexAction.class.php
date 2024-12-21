<?php

class dashboard_indexAction extends mfAction {
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();       
     //  echo "<pre>"; var_dump($this->getUser()); echo "</pre>"; 
        $this->user=$this->getUser();
    }         	
	
}

