<?php


class UserEmailEngineBase extends mfEmailEngineCore {
    
    protected $user=null;
        
    function __construct(User $user,$options=array(),$site=null) {
       $this->user=$user;                   
       parent::__construct($options, $site);
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getMailer()
    {
        return $this->mailer;
    }
    
    function configure()
    {
        $this->settings=new UserSettings();
    }
    
    function getUser()
    {
        return $this->user;
    }    
    
    function getSettings()
    {
        return $this->settings;
    }
    
    
   /* function sendPasswordByMailer()
    {                      
        try
        {                  
           $message=$action->getComponent('/customers_communication_emails/emailForContract', array('COMMENT'=>false,'contract'=>$contract,'model_i18n'=>$model_i18n))->getContent();                            
        }
        catch (SmartyCompilerException $e)
        {
            //trigger_error($e->getMessage());
            throw new mfException(__("Error Syntax in model."));              
        }      
        return $this;
    }*/
     
   
    function sendValidationToken(UserValidationToken $token,$email)
    {                  
           //$this->getMailer()->debug();
           $this->getMailer()->sendMail(                                   
                                      'users',
                                      'emailValidationToken',
                                      array('no-reply@icall26.com'=>'icall26'), 
                                      $email, 
                                      __("iCall26: ").$token->get('message'),
                                      array("token"=> $token)                                        
                                      );   
                 
        return $this;
    }
    
    
    function sendAuthentification()
    {                  
          // $this->getMailer()->debug();       
        try
        {
           $this->getMailer()->sendMail(                                   
                                      'users',
                                      'emailAuthentification',
                                      array('no-reply@icall26.com'=>'icall26'), 
                                      $this->getUser()->get('email'), 
                                      __("iCall26: account connection")                                                                          
                                      );   
        }
        catch (Exception $e)
        {                        
            trigger_error($e->getMessage());
        }      
        return $this;
    }
}

