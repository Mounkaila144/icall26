<?php


class customers_accountAction extends mfAction {
    
     
     function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
        $this->getResponse()->addJavascript('i18n/highcharts-'.$this->getUser()->getCountry().'.js',array('module'=>'highcharts'));
    }
    
    function execute(mfWebRequest $request) {       
        if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
            $this->redirect(to_link_i18n(mfConfig::get('mf_customer_redirect_signin')));
        $messages = mfMessages::getInstance();                     
    }
    
   
}


