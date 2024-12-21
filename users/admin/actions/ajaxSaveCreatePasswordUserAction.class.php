<?php

require_once dirname(__FILE__)."/../locales/Forms/CreatePasswordUserForm.class.php";


class users_ajaxSaveCreatePasswordUserAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();        
        try 
        {
            $this->user = new User($request->getPostParameter('User'),'admin'); 
            if (!$this->user->isAuthorized('view'))
                  $this->forwardTo401Action();  
            $this->form = new CreatePasswordUserForm(array());   
            if ($request->isMethod('POST') && $request->getPostParameter('User')!=null)
            {                                       
                    $this->form->bind($request->getPostParameter('User'));
                    if ($this->form->isValid()) 
                    {
                        $this->user->add($this->form->getValues());
                        $this->password = (string)$this->form['password'];
                        $this->user->encryptPassword()->save();                    
                        $messages->addInfo(__("Password for [%s] has been created.",(string)$this->user));
                        $this->getEventDispather()->notify(new mfEvent($this->user, 'user.change','password.created')); 
                        if ($this->user->get('email'))
                             $this->sendEmail();
                        $this->forward('users','ajaxListPartial');
                    }
                    else
                    {    
                       $this->user->add($request->getPostParameter('User'));
                       $messages->addError(__("Forms has some errors."));                      
                    }               
           }      
       } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        catch (Exception $e)
        {
           $messages->addError(__('Fatal error during email sending'));
        }
    }

    function sendEmail()
    {                
         $this->company=SiteCompanyUtils::getSiteCompany();             
         if (!$this->company)
              throw new mfException(__("Company information has to be completed."));
         $fromEmail=$this->company->get('email'); 
         $boutiqueName=$this->company->get('name');              
         try 
         {           
          //  $this->getMailer()->debug();
            $this->getMailer()->sendMail('users','emailPasswordRegenerated',array($fromEmail => $boutiqueName), $this->user->get('email'), __("new password"),$this); 
         }
         catch (Swift_TransportException $e)
         {
             throw new mfException(__('Error occurs during email sending.'));
         }
    }
}
