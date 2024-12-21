<?php


class users_SendValidationAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {            
       $messages = mfMessages::getInstance();    
       try
       {
            if ($request->getRequestParameter('token',false))
            {              
                $this->settings = new UserValidationSettings();
                if (!$this->settings->hasEmail())
                    throw new mfException(__("No email exists for validation."));                
                $engine=new UserEmailEngine($this->getUser()->getGuardUser());
                $engine->sendValidationToken($request->getRequestParameter('token'),$this->settings->get('email'));
                return ;
            }                                                
       }
       catch (mfException $e)
       {
           $messages->addError($e);
       }
    //   die(__METHOD__);
   }

}

