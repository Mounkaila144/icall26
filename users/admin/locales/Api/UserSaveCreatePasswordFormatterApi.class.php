<?php

require_once __DIR__."/CreatePasswordUserFormatterApi.class.php";

class UserSaveCreatePasswordFormatterApi extends CreatePasswordUserFormatterApi {

    function getAction(){
        return  mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    }
            
    function process()
    {        
        try
        {                         
            
                                     
                    if ($this->getForm()->isValid()) 
                    {
                        $this->getItem()->add($this->getForm()->getValues());
                        $password = (string)$this->getForm()['password'];
                        $this->getItem()->encryptPassword()->save();  
                        $this->data['errors']=__("Password for [%s] has been created.",(string)$this->getItem());
                        $this->getAction()->getEventDispather()->notify(new mfEvent($this->getItem(), 'user.change','password.created')); 
                        if ($this->getItem()->get('email'))
                             $this->sendEmail();
                    }
                    else
                    {    
                      return $this->data['errors']=$this->getForm()->getErrorSchema()->getErrorsMessage();                     
                    }               
                                                            
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }

    function sendEmail()
    {                
         $company=SiteCompanyUtils::getSiteCompany();             
         if (!$company)
             return $this->data['errors']=__("Company information has to be completed.");
         $fromEmail=$company->get('email'); 
         $boutiqueName=$company->get('name');              
         try 
         {           
          //  $this->getMailer()->debug();
            $this->getAction()->getMailer()->sendMail('users','emailPasswordRegenerated',array($fromEmail => $boutiqueName), $this->getItem()->get('email'), __("new password"),$this); 
         }
         catch (Swift_TransportException $e)
         {
             return $this->data['errors']=__('Error occurs during email sending.');
         }
    }
}

