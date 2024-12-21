<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerModifyForm.class.php";
 
class customers_ajaxModifyCustomerForContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
  /*  function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }*/
        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site); 
        if ($this->contract->isNotloaded())
            return ;
        $this->form = new CustomerModifyForm();      
   }

}

