<?php


require_once dirname(__FILE__)."/../locales/Forms/CustomerCheckEmailForm.class.php";

class customers_ajaxCheckEmailAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {           
        $messages = mfMessages::getInstance();            
        try 
        {
            $form = new CustomerCheckEmailForm($request->getPostParameter('CheckEmail'));
            $form->bind($request->getPostParameter('CheckEmail'));
            if ($form->isValid())
            {               
                $response=array("status"=>"OK");
            }  
            else
            {
                $response=array("errors"=>array("email"=>(string)$form['email']->getError()));
            }               
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
    
   
}


