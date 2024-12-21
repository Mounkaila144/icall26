<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUserLoginMobileForm.class.php";

class customers_loginForMobileAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {        
        // check if mobile ?
        $messages = mfMessages::getInstance();
        if (!$request->isMethod('POST'))
             return array('status'=>'no credential');          
        $form = new CustomerUserLoginMobileForm($request->getPostParameters());      
        try {                        
                $form->bind($request->getPostParameters());
                if (!$form->isValid()) 
                    return array('status'=>'ERROR');                                         
                  $this->getUser()->signin($form->getUser(),$request->getIP());                                                                       
                  return   $form->getValues();                                     
             //   else var_dump ($form->getErrorSchema()->getErrorsMessage());
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
    
   
}


