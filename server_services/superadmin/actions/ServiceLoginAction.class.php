<?php

require_once dirname(__FILE__).'/../locales/Forms/LoginServicesForm.class.php';

class server_services_ServiceLoginAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {       
        $messages = mfMessages::getInstance();                     
        try 
        {                             
            $settings= new ServerServicesSettings();      
            if (!$settings->getAuthorizedIps()->in($request->getIP()))
              $this->forwardTo401Action ();
            
             $form = new LoginServicesForm(); 
            if ($request->isMethod('POST')) 
            {
               // var_dump($request->getPostParameters());               
                $form->bind($request->getPostParameters());
                if ($form->isValid()) 
                {                   
                    $values = $form->getValues();
                    $this->getUser()->signin($values['user']);       
                    //$this->getEventDispather()->notify(new mfEvent($values['user'], 'user.connected')); 
                    $response=array('status'=>'OK','token'=>$form->getToken());                     
                } 
                else
                {
                   // var_dump($form->getErrorSchema()->getErrorsMessage());
                   $response=array('status'=>'error','errors'=>'invalid');
                }     
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response; 
    }

}
