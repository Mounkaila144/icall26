<?php

class users_ajaxDashboardRegeneratePasswordUserAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->user=new User($request->getPostParameter('id'));          
        if ($this->user->isLoaded())
        {    
            $this->password=mfTools::generatePassword(8);
            $this->user->add(array("password"=>md5($this->password),"last_password_gen"=>date("Y-m-d H:i:s")));
            $this->user->save();
            try
            {             
             //   $this->company=CompanyUtils::getSiteCompany(); // Load current company on this site
             //   if (!$this->company)
             //        throw new mfException(__("company information has to be completed."));
                $fromEmail="admin@ewebsolutionskech-dev.com";//$this->company->get('email'); 
                $boutiqueName='admin'; //$this->company->get('name',);
                $this->getMailer()->sendMail('users','emailDashboardPasswordRegenerated',array($fromEmail => $boutiqueName), $this->user->get('email'), __("new password"),$this); 
                $response=array("info"=>__("Email with new password has been sent to (%s) for [%s].",array($this->user->get('email'),(string)$this->user)),
                                "action"=>"RegeneratePasswordUser",
                                "params"=>array("id"=>$this->user->get('id'),
                                                "date"=>$this->user->get('last_password_gen')
                                                )
                               );
            }
            catch (Exception $e)
            {
                $messages->addError($e);
            }
        }    
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
