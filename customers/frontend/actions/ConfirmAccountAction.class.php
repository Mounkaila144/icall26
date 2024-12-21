<?php



class customers_ConfirmAccountAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->model=CustomerSettings::load()->getAccountConfirmTextModel();       
        $this->validation=new CustomerUserValidation(array('email'=>$request->getGetParameter('email'),'key'=>$request->getGetParameter('key')));               
        if ($this->validation->isLoaded())      
            $this->validation->getUser()->enable();                  
    }
    
   
}


