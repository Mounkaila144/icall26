<?php


class app_domoprime_ExportBillingExtendedPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          
          
          
          $billing=new DomoprimeBilling($request->getGetParameter(__('Billing')));         
          if ($billing->isNotLoaded())
             $this->forward404File();          
          $model=DomoprimeSettings::load()->getModelForBilling();          
          if ($model->isNotLoaded())
              throw new mfException( __("Model is invalid."));
         /* $pdf=new DomoprimeBillingPDF($model,$quotation);
          if ($request->getGetParameter('debug')=='true')
              $pdf->output();
          else
              $pdf->forceOutput();  */     
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}

