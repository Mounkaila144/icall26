<?php
// www.ecosol16.net/admin/api/v2/applications/iso/admin/ExportPdfQuotation
// https://dev32a.icall26.net/admin/api/v2/applications/iso/admin/ExportPdfQuotation


//require_once __DIR__."/../locales/Api/v2/DomoprimeBillingListFormatterApi2.class.php";

class app_domoprime_api2ExportPdfQuotationAction extends mfAction {

    function execute(mfWebRequest $request) {        
         $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
      $messages = mfMessages::getInstance();                                
      if (!$this->getUser()->hasCredential([['superadmin','api_v2_app_domoprime_quotation_export_pdf']]))
            $this->forwardTo401Action();
      try 
      {        
          $quotation=new DomoprimeQuotation($request->getGetParameter('quotation'));         
          if ($quotation->isNotLoaded())
              throw new mfException('quotation is invalid.');
          if ($quotation->hasContract() && $quotation->getContract()->hasPolluter())
          {              
              $polluter_quotation_model=new DomoprimePolluterQuotation($quotation->getContract()->getPolluter());
              $model=$polluter_quotation_model->getModel();                  
          }                    
          elseif ($quotation->hasMeeting() && $quotation->getMeeting()->hasPolluter())
          {
              $polluter_quotation_model=new DomoprimePolluterQuotation($quotation->getMeeting()->getPolluter());
              $model=$polluter_quotation_model->getModel();             
          }
          if ($model==null || $model->isNotLoaded())
          {    
              $model=DomoprimeSettings::load()->getModelForQuotation();     
          }         
          if ($model->isNotLoaded())
              throw new mfException( __("Model is invalid."));         
                             
          $pdf=DomoprimePdfEngine::getInstance()->getQuotationEngine($model,$quotation,$polluter_quotation_model);              
          $pdf->forceOutput();    
          die();          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("errors"=>$messages->getDecodedErrors()):array();
    }

}