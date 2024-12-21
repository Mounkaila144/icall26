<?php

class DomoprimeBillingEmailEngine  extends mfEmailEngineCore {
    
    protected $billing,$messages;
    
    function __construct(DomoprimeBilling $billing,$options=array()) {
        $this->billing=$billing;
        $this->site=$billing->getSite();
        $this->messages=new mfArray();
        parent::__construct($options, $billing->getSite());
    }
    
    function getUser()
    {
        return mfContext::getInstance()->getUser();
    }    
    
    function getSite()
    {
        return $this->site;
    }

    function getBilling()
    {
        return $this->billing;
    }
    
    function getMessages()
    {        
        return $this->messages;
    }
    
   
    function send()
    {
            $settings=DomoprimeSettings::load();
            if (!$settings->hasEmailBillingModel()) 
                  throw new mfException(__("Email model is missing."));
            if (!$this->getBilling()->getCustomer()->hasEmail())
                  throw new mfException(__("Customer email is missing."));
           $model=null;
          if ($this->getBilling()->hasContract() && $this->getBilling()->getContract()->hasPolluter())
          {              
              $polluter_billing_model=new DomoprimePolluterBilling($this->getBilling()->getContract()->getPolluter());
              $model=$polluter_billing_model->getModel();                 
          }      
           elseif ($this->getBilling()->hasMeeting() && $this->getBilling()->getMeeting()->hasPolluter())
          {
              $polluter_billing_model=new DomoprimePolluterBilling($billing->getMeeting()->getPolluter());
              $model=$polluter_billing_model->getModel();             
          }
          if ($model==null || $model->isNotLoaded())
          {    
            $model=DomoprimeSettings::load()->getModelForBilling();     
          }                 
          if ($model->isNotLoaded())
              throw new mfException( __("Model is invalid."));
          
           $pdf=DomoprimePdfEngine::getInstance()->getBillingEngine($model,$this->getBilling());   
           $pdf->save();
          
          try
            {
                 $company=SiteCompanyUtils::getSiteCompany($this->getSite());   
              // Record Email
              $email=new CustomerEmailSent();
              $email->add(array('model_id'=>$settings->getEmailBillingModel(),
                                'email'=>$this->getBilling()->getCustomer()->get('email'),
                                'subject'=>$settings->getEmailBillingModel()->getI18n()->get('subject'), 
                                'customer_id'=>$this->getBilling()->getCustomer()
                          ));        
           //  $this->getMailer()->debug();
             $this->getMailer()->sendMail('app_domoprime','emailBilling',
                                      (method_exists($this->getMailer(),'getSender')?$this->getMailer()->getSender():$company->get('email')), 
                                      $this->getBilling()->getCustomer()->get('email'), 
                                      $settings->getEmailBillingModel()->getI18n()->get('subject'), 
                                      array('billing'=>$this->getBilling(),'email'=>$email),
                                      (array)$this->getBilling()->getFilenameForPdf()
                        );
             $email->isSent(); 
             $this->messages[]=__("Billing has been sent to customer [%s at %s]",array((string)$this->getBilling()->getCustomer(),$this->getBilling()->getCustomer()->get('email')));
            } 
            catch (Swift_TransportException $e) 
            {
                $this->messages[]=$e->getMessage();
                  //$messages->addError($e);
            } 
            catch (Swift_MimeException $e) 
            {
                $this->messages[]=$e->getMessage();
                  //$messages->addError($e);
            }    
            $email->set('body',$this->getSiteMailer()->getContent());               
            $email->save();          
            // Record history
            $history=new CustomerEmailHistory();
            $history->setUser($this->getUser()->getGuardUser());
            $history->setEmail($email);
            $history->save();      
                                         
    }
}
