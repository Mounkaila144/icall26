<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerAttributionsForm.class.php";



class customers_contracts_ajaxModifyAttributionsAction extends mfAction {
    
        
    
 
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));    
        $this->form= new CustomerAttributionsForm($this->contract,$this->user);               
       // echo "id".$this->contract->get('id');
       // var_dump($this->contract->getContributors());
    }

}
