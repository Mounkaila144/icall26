<?php

class app_domoprime_ajaxSendQuotationEmailForContractAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();                      
        $this->item=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation')); 
        $this->country=$this->getUser()->getCountry();
        $model_email=new CustomerModelEmailI18n($request->getPostParameter('ModelEmail'));      
        try 
        {           
                if (!$this->item->getContract()->getCustomer()->get('email'))
                    throw new mfException(__("Email doesn't exist, you have to complete it."));         
                $company=SiteCompanyUtils::getSiteCompany();   
                // Send Email
                $email=new CustomerEmailSent();
               // $this->getMailer()->debug(); 
                try
                {
                    $model=null;
                    $settings=new DomoprimeSettings();
                    if ($this->item->hasContract() && $this->item->getContract()->hasPolluter())
                    {              
                        $polluter_quotation_model=new DomoprimePolluterQuotation($this->item->getContract()->getPolluter());
                        $model=$polluter_quotation_model->getModel();            
                    }                    
                    if ($model==null || $model->isNotLoaded())
                    {    
                      $model=$settings->getModelForQuotation();     
                    }         
                    if ($model->isNotLoaded())
                        throw new mfException( __("Model is invalid."));
                    $pdf=DomoprimePdfEngine::getInstance()->getQuotationEngine($model,$this->item,$polluter_quotation_model);   
                    $pdf->save();
                    $this->getMailer()->sendMail(                                   
                                      'app_domoprime',
                                      'emailQuotation',
                                      $company->get('email'),  
                                      $this->item->getContract()->getCustomer()->get('email'), 
                                      $model_email->get('subject') ,
                                      array("quotation"=> $this->item,'model'=>$model_email),
                                      array($pdf->getFilename())
                                      );
                                      
                                    $messages->addInfo(__(' Quotation has been sent to [{customer} - {email}].',array('customer'=>(string) $this->item->getContract()->getCustomer(),'email'=>$this->item->getContract()->getCustomer()->get('email'))));
                                  
                    $email->isSent();                   
                    $response=array('info'=>__(' Quotation has been sent to [{customer} - {email}].',array('customer'=>(string) $this->item->getContract()->getCustomer(),'email'=>$this->item->getContract()->getCustomer()->get('email'))),"action"=>"SendEmail");
                    
                } 
                catch (Swift_TransportException $e) 
                {
                        $messages->addError($e);
                } 
                catch (Swift_MimeException $e) 
                {
                    
                        $messages->addError($e);
                }    
                catch (Exception $e) 
                {
                   
                        $messages->addError($e);
                }   
                
                // History
                $email->set('customer_id', $this->item->getContract()->getCustomer());               
                $email->set('email', $this->item->getContract()->getCustomer()->get('email'));
                $email->set('subject', $model_email->get('subject'));
                // Record Email               
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
