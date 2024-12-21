<?php

require_once __DIR__."/../locales/Forms/ExportBillingsPdfForm.class.php";

class app_domoprime_ajaxExportBillingsPdfBatchAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $form=new ExportBillingsPdfForm($request->getPostParameter('DomoprimeBillingsPDF'));
          $form->bind($request->getPostParameter('DomoprimeBillingsPDF'));
          if (!$form->isValid())
              throw new mfException(__('Form has some error.'));
          if (!mfModule::isModuleInstalled('utils_documents_pdf'))
              throw new mfException(__('Resource Batch PDF is not installed.'));        
          $batch=new DomoprimeDocumentBillingPdf();           
          $batch->setUserAndParameters($form->getSelection(),$this->getUser()->getGuardUser());           
          if ($batch->isExist())
              throw new mfException(__('Work has already been started.'));
          if (!$batch->isValid())           
              throw new mfException(__("Quotations for contracts [%s] don't exist.",$batch->getContractsWithoutQuotations()->implode(", ")));            
          $batch->create();
          $response=array('action'=>'DomoprimeBillingsPDF',                          
                          'info'=>__('Batch has been generated. (%s billings will be generated)',$form->getSelection()->count()));
      } 
      catch (mfException $e) {
          $messages->addError($e);         
      } 
     return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

