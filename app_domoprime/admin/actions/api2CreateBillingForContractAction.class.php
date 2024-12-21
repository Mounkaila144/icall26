<?php

// www.ecosol16.net/admin/api/v2/applications/iso/admin/CreateBillingForContract

class CreateBillingForContract extends mfForm {
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
           'to_send'=>new mfValidatorBoolean(array()) ,
           'has_asset'=>new mfValidatorBoolean(array()) 
        ));
    }
    
    function toSend()
    {
        return $this['to_send']->getValue();
    }
    
    function hasAsset()
    {
        return $this['has_asset']->getValue();
    }
    
}
class app_domoprime_api2CreateBillingForContractAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {     
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
         if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_api2_create_billing_for_contract'))))
            $this->forwardTo401Action();
        
        
      $messages = mfMessages::getInstance();   
      try 
      {   
          $infos=new mfArray();
          $contract=new CustomerContract($request->getGetAndPostParameter('contract'));      
          if ($contract->isNotLoaded())
              throw new mfException(__("Contract is invalid."));         
          if (!$contract->hasOpcAt())
              throw new mfException(__("Opc date doesn't exist."));
          $quotation=new DomoprimeQuotation($request->getGetAndPostParameter('quotation'));
          if ($quotation->isNotLoaded())
              throw new mfException(__("Quotation is invalid."));   
           $form=new CreateBillingForContract();
          $form->bind($request->getGetAndPostParameter('options'));
          if (!$form->isValid())
              throw new mfException(__('Form has some errors.'));
       //   if ($this->getUser()->hasCredential(array(array('app_domoprime_contract_create_billing_validation'))))            
              $this->getEventDispather()->notify(new mfEvent($quotation, 'app.domoprime.contract.create_billing'));     
          if ($form->hasAsset())
          {
             $last_billing=new DomoprimeBilling($contract);
             $asset=new DomoprimeAsset();
             $asset->createFromBilling($last_billing,$this->getUser()->getGuardUser());         
          }      
          elseif ($this->getUser()->hasCredential([['app_domoprime_iso_create_asset_for_billing']]))
          {
              $last_billing=new DomoprimeBilling($quotation->getContract());
              if ($last_billing->isLoaded())
              {
                    $asset=new DomoprimeAsset();
                    $asset->createFromBilling($last_billing,$this->getUser()->getGuardUser());                 
              }    
          } 
          $billing=new DomoprimeBilling();          
          $billing->createFromQuotation($contract,$quotation,$this->getUser());          
          $contract->setClosedAtFromOpcAt();                 
          if ($form->toSend())
          {
              $this->sendEmail($billing,$messages,$infos);
          }           
          $response = array( 
                          //  "url"=>$billing->getUrl(),
                            "reference"=>$billing->getFormatter()->getText(),
                            "id"=>$billing->get('id'),
                           );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      } 
      catch (Exception $e) {
          $messages->addError($e);
      } 
     return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
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
        //  $pdf=new DomoprimeBillingPDF($model,$billing);        
        //  $pdf->save();   
		
			 $pdf=DomoprimePdfEngine::getInstance()->getBillingEngine($model,$billing);   
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
            $email->set('body',$this->getSiteMailer()->getContent());               
            $email->save();          
            // Record history
            $history=new CustomerEmailHistory();
            $history->setUser($this->getUser()->getGuardUser());
            $history->setEmail($email);
            $history->save();      
    }
}

