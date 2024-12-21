<?php

class users_ajaxRegeneratePasswordAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {       
        $messages = mfMessages::getInstance();      
        $this->user = new User($request->getPostParameter('id'), array('admin', 'frontend'));
        if ($this->user->isLoaded()) {
            $this->password = mfTools::generatePassword(8);
            $this->user->add(array("password" => md5($this->password),"last_password_gen"=>date("Y-m-d H:i:s")));
            $this->user->save();
            try 
            {
                $this->company=SiteCompanyUtils::getSiteCompany();             
                if (!$this->company)
                     throw new mfException(__("Company information has to be completed."));
                $fromEmail=$this->company->get('email'); 
                $boutiqueName=$this->company->get('name');
            //    $this->getMailer()->debug();
                $this->getMailer()->sendMail('users','emailPasswordRegenerated',array($fromEmail => $boutiqueName), $this->user->get('email'), __("new password"),$this); 
                $response = array("info" =>__("Email has been sent with new password to (%s).",$this->user->get('email')),
                                  "action"=>"RegeneratePasswordUser",
                                  "params"=>array("id"=>$this->user->get('id'),
                                                "date"=>$this->user->get('last_password_gen')
                                                )
                                 );
            } catch (Exception $e) {
                $messages->addError($e);
            }
        }        
        return $messages->hasErrors() ? array("error" => $messages->getDecodedErrors()) : $response;
    }

}
