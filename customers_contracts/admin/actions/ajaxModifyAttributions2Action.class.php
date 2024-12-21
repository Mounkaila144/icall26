<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerAttributions2Form.class.php";



class customers_contracts_ajaxModifyAttributions2Action extends mfAction {
    
        
    
 
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));    
        $this->form= new CustomerAttributions2Form($this->contract,$this->user);               
       // echo "id".$this->contract->get('id');
       // var_dump($this->contract->getContributors());
    }

}
