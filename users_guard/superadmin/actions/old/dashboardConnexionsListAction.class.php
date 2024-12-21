<?php

require dirname(__FILE__)."/ajaxDashboardConnexionsListPartialAction.class.php";

class userGuard_dashboardConnexionsListAction  extends userGuard_ajaxDashboardConnexionsListPartialAction {
    
    
    function postExecute() {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
}