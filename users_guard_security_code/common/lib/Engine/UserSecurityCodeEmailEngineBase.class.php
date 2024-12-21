<?php


class UserSecurityCodeEmailEngineBase extends mfEmailEngineCore {
    
    protected $user=null,$site=null;
        
    function __construct(User $user,$options=array(),$site=null) {
       $this->user=$user;   
       $this->site=$site;   
       $this->validation_settings= new UserValidationSettings();
       parent::__construct($options, $user->getSite());
    }
    
    
    function getMailer()
    {
        return $this->mailer;
    }
    
   /* function configure()
    {
        $this->settings=new UserSettings();
    }*/
    
    function getUser()
    {
        return $this->user;
    }       
  
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function getValidationSettings(){        
        return $this->validation_settings;         
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
     
   
    function sendCode()
    {                    
        if (!$this->getUser()->hasEmail())
               return $this;        
           $code = new UserSecurityCode($this->getUser());
           $code->create();           
           //$this->getMailer()->debug(); 
           $email = mfConfig::get('mf_app')=='superadmin'?array('no-reply@icall26.com'=>'icall26'):$this->getCompany()->getEmailWithName();
         try
        {  
           $this->getMailer()->sendMail(                                   
                    'users_guard_security_code',
                    'emailCode',
                    $email, 
                    $this->getUser()->get('email') ,
                    __("iCall26: authentification validation pour ".$this->getSite()->getHost()),
                    array("code"=> $code),
                    array(),
                    (!$this->getUser()->isSuperAdminByPermissions(new mfArray(['superadmin'])) && $this->getValidationSettings()->hasEmail()?array($this->getValidationSettings()->get('email')):array())
                );   
        }
        catch (Exception $e)
        {                        
            trigger_error($e->getMessage());
        }
        return $this;
    }
}

