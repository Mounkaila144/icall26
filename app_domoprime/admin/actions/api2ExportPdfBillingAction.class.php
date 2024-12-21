<?php
// www.ecosol16.net/admin/api/v2/applications/iso/admin/ExportPdfBilling
// https://dev32a.icall26.net/admin/api/v2/applications/iso/admin/ExportPdfBilling


//require_once __DIR__."/../locales/Api/v2/DomoprimeBillingListFormatterApi2.class.php";

class app_domoprime_api2ExportPdfBillingAction extends mfAction {

    function execute(mfWebRequest $request) {        
         $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
      $messages = mfMessages::getInstance();                                
      if (!$this->getUser()->hasCredential([['superadmin','api_v2_app_domoprime_billing_export_pdf']]))
            $this->forwardTo401Action();
      try 
      {        
          $billing=new DomoprimeBilling($request->getGetParameter('billing'));         
          if ($billing->isNotLoaded())
              throw new mfException('billing is invalid.');
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
                             
          $pdf=DomoprimePdfEngine::getInstance()->getBillingEngine($model,$billing,$polluter_billing_model);              
          $pdf->forceOutput();    
          die();          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("errors"=>$messages->getDecodedErrors()):array();
    }

}