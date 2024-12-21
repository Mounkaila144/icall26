<?php

require_once __DIR__."/../locales/Forms/ExportBillingsPdfForm.class.php";

class app_domoprime_ajaxExportBillingsPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $form=new ExportBillingsPdfForm($request->getPostParameter('DomoprimeBillingsPDF'));
          $form->bind($request->getPostParameter('DomoprimeBillingsPDF'));
          if (!$form->isValid())
              throw new mfException(__('Form has some error.'));
          $model=DomoprimeSettings::load()->getModelForBilling();          
          if ($model->isNotLoaded())
              throw new mfException( __("Model is invalid."));
          $pdf=new DomoprimeBillingsPDF($form->getBillings(),$model);    
          $pdf->save();       
          $response=array('action'=>'DomoprimeBillingsPDF',
                          'url'=>$pdf->getUrl(),
                          'info'=>__('PDF file has been generated. (%s billings have been generated)',$form->getBillings()->count()));
      } 
      catch (mfException $e) {
          $messages->addError($e);         
      } 
     return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

