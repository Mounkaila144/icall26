<?php

class UpdateBillingFromLastQuotationForContractForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
           'to_send'=>new mfValidatorBoolean(array()) ,
         //  'has_asset'=>new mfValidatorBoolean(array()) 
        ));
    }
    
    function toSend()
    {
        return $this['to_send']->getValue();
    }
    
   /* function hasAsset()
    {
        return $this['has_asset']->getValue();
    }*/
    
}
class app_domoprime_ajaxUpdateBillingFromLastQuotationForContractAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {   
          $infos=new mfArray();
          $contract=new CustomerContract($request->getPostParameter('Contract'));      
          if ($contract->isNotLoaded())
              throw new mfException(__("Contract is invalid."));         
          if (!$contract->hasOpcAt())
              throw new mfException(__("Opc date doesn't exist."));
          $quotation=new DomoprimeQuotation($contract);         
          if ($quotation->isNotLoaded())
              throw new mfException(__("Quotation is invalid."));  
          $billing=new DomoprimeBilling($contract);         
          if ($billing->isNotLoaded())
              throw new mfException(__("Billing is invalid."));  
                              
          $form=new UpdateBillingFromLastQuotationForContractForm();
          $form->bind($request->getPostParameter('Billing'));
          if (!$form->isValid())
              throw new mfException(__('Form has some errors.'));
          
          $billing->updateFromQuotationWithUser($quotation,$this->getUSer());
                             
          $contract->setClosedAtFromOpcAt();         
          $infos[]=__("Billing has been created.");          
          if ($form->toSend())
          {
              $this->sendEmail($billing,$messages,$infos);
          }  
          $response = array("action"=>"UpdateBillingFromLastQuotationForContract",
                           "url"=>$billing->getUrl(),
                           "reference"=>$billing->getFormatter()->getText(),
                            "id"=>$billing->get('id'),
                            "info"=>$infos->toArray());
      } 
      catch (mfException $e) {
          $messages->addError($e);
      } 
      catch (Exception $e) {
          $messages->addError($e);
      } 
     return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors(),'info'=>$infos->toArray()):$response;
    }
    
    
    
    function sendEmail(DomoprimeBilling $billing,$messages,$infos)
    {
            $settings=DomoprimeSettings::load();
            if (!$settings->hasEmailBillingModel()) 
                  throw new mfException(__("Email model is missing."));
            if (!$billing->getCustomer()->hasEmail())
                  throw new mfException(__("Customer email is missing."));
           $model=null;
          if ($billing->hasContract() && $billing->getContract()->hasPolluter())
          {              
              $polluter_billing_model=new DomoprimePolluterBilling($billing->getContract()->getPolluter());
              $model=$polluter_billing_model->getModel();                 
          }      
           elseif ($billing->hasMeeting() && $billing->getMeeting()->hasPolluter())
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
          $pdf=new DomoprimeBillingPDF($model,$billing);        
          $pdf->save();   
          
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
           //  $this->getMailer()->debug();
             $this->getSiteMailer()->sendMail('app_domoprime','emailBilling',
                                      $this->getSiteMailer()->getSender(), 
                                      $billing->getCustomer()->get('email'), 
                                      $settings->getEmailBillingModel()->getI18n()->get('subject'), 
                                      array('billing'=>$billing,'email'=>$email),
                                      (array)$billing->getFilenameForPdf()
                        );
             $email->isSent(); 
             $infos[]=__("Billing has been sent to customer [%s at %s]",array((string)$billing->getCustomer(),$billing->getCustomer()->get('email')));
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
}

