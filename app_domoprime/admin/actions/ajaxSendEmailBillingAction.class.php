<?php


 
class app_domoprime_ajaxSendEmailBillingAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {    
          $settings=DomoprimeSettings::load();
          $billing=new DomoprimeBilling($request->getPostParameter('Billing'));         
          if ($billing->isNotLoaded())            
              throw new mfException(__("Billing is invalid."));
          if (!$billing->getFileForPdf()->isExist())
          {                 
            if ($settings->getModelForBilling()->isNotLoaded())
                throw new mfException( __("Billing model is invalid."));
            $pdf=new DomoprimeBillingPDF($settings->getModelForBilling(),$billing);            
            $pdf->save();  
          }         
          if (!$settings->hasEmailBillingModel()) 
              throw new mfException(__("Email model is missing."));
          if (!$billing->getCustomer()->hasEmail())
              throw new mfException(__("Customer email is missing."));
          try
         {
              $company=SiteCompanyUtils::getSiteCompany();   
                // Record Email
              $email=new CustomerEmailSent();
              $email->add(array('model_id'=>$settings->getEmailBillingModel(),
                                'email'=>$billing->getCustomer()->get('email'),
                                'subject'=>$settings->getEmailBillingModel()->getI18n()->get('subject'), 
                                'customer_id'=>$billing->getCustomer()
                          ));        
          //   $this->getMailer()->debug();
             $this->getSiteMailer()->sendMail('app_domoprime','emailBilling',
                                      $this->getSiteMailer()->getSender(), 
                                      $billing->getCustomer()->get('email'), 
                                      $settings->getEmailBillingModel()->getI18n()->get('subject'), 
                                      array('billing'=>$billing,'email'=>$email),
                                      (array)$billing->getFilenameForPdf()
                        );
             $email->isSent();                          
             $response = array("action"=>"SendEmailBilling","id" =>$billing->get('id'),"info"=>__('Email send to [{customer} - {email}].',array('customer'=>(string)$billing->getCustomer(),'email'=>$billing->getCustomer()->get('email'))));
          }
          catch (Swift_TransportException $e) 
          {
                $messages->addError($e);
          } 
          catch (Swift_MimeException $e) 
          {
                $messages->addError($e);
          }    
         $email->set('body',$this->getMailer()->getContent());               
         $email->save();          
            // Record history
          $history=new CustomerEmailHistory();
          $history->setUser($this->getUser()->getGuardUser());
          $history->setEmail($email);
          $history->save();                
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

