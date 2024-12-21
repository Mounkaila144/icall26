<?php

require dirname(__FILE__)."/ajaxConnexionsListPartialAction.class.php";

class userGuard_ajaxConnexionsListAction  extends userGuard_ajaxConnexionsListPartialAction {
    
    
    function preExecute() {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');       
    }
}