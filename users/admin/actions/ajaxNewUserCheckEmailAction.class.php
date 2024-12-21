<?php

require_once dirname(__FILE__)."/../locales/Forms/UserNewCheckEmailForm.class.php";


class users_ajaxNewUserCheckEmailAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
        try 
        {                     
            $form = new UserNewCheckEmailForm(array(),$this->site);            
            if ($request->isMethod('POST') && $request->getPostParameter('UserEmail'))
            {                                    
                    $form->bind($request->getPostParameter('UserEmail'));
                    if ($form->isValid()) 
                    {                       
                        if ($form->isEmailExist())
                            $response=array(
                                'warning'=>__("Email already exists.")
                            );
                    }    
                    // else var_dump($form->getErrorSchema ());
           }             
       } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
