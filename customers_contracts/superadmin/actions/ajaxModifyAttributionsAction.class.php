<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerAttributionsForm.class.php";



class customers_contracts_ajaxModifyAttributionsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
  /*  function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }*/
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->form= new CustomerAttributionsForm(array(),$this->site);
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site);    
       // var_dump($this->form->contributors);
      /*    foreach ($this->contract->getContributors() as $contributor)
        {
           // var_dump($this->form->contributors[$contributor->get('type')]['attribution_id']);
           //  var_dump($this->form->contributors[$contributor->get('type')][$contributor->get('type')]);
          //    var_dump($contributor);
        }   */
    }

}
