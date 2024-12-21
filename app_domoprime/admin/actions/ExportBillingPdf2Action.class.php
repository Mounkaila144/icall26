<?php


class app_domoprime_ExportBillingPdf2Action extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $settings=DomoprimeSettings::load();
          $billing=new DomoprimeBilling($request->getGetParameter(__('Billing')));            
          if ($billing->isNotLoaded())
             $this->forward404File();           
          if (!$billing->isOwner() && !$this->getUser()->hasCredential(array(array('superadmin','admin','iso_billing_owner'))))            
             $this->forwardTo401Action();              
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
          $pdf=new DomoprimeBillingPDF2($model,$billing);
          if ($request->getGetParameter('debug')=='true')
              $pdf->output();
          else
              $pdf->forceOutput();         
          if ($settings->get('billing_archivage')=='YES')
          {             
              $document=new CustomerDocument();
              $document->createDocument($billing->getContract()->getCustomer(),__("Billing"),__("Billing"),$pdf->getFile());                              
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
      // var_dump($messages->getDecodedErrors());
      die();
    }
}

