<?php


class app_domoprime_ExportPolluterAfterWorkDocumentPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $contract=new CustomerContract($request->getGetParameter('Contract'));         
          if ($contract->isNotLoaded())
             throw new mfException(__("Contract is invalid."));
          if (!$contract->hasPolluter())
              throw new mfException(__("No polluter."));                      
          $polluter_afterwork_model=new DomoprimePolluterAfterWork($contract->getPolluter());
          $model=$polluter_afterwork_model->getModel();                 
          if ($model->isNotLoaded())
              throw new mfException(__("Polluter After work Model is invalid."));                          
          $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.afterwork.process.pdf')); 
          if ($model->getI18n()->hasFile())
          {
             if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
             $base_pdf=new DomoprimeAfterWorkDocumentPdf($contract,$model);
             $base_pdf->save(); 
             
             $pdf= new DomoprimeAfterWorkDocumentGeneratorPdf($base_pdf, $polluter_afterwork_model);
             $pdf->process();  
          
             
             ob_start();
             ob_end_clean();          
             $response=$this->getResponse();      
             $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
             $response->setHttpHeader("Content-disposition","inline; filename=".$model->getName());      
             $response->sendFile($pdf->getFilename(),0,0);                             
          }    
          else
          {
              echo "Not supported"; die();                          
          }                   
      } 
      catch (mfException $e) {
          echo $e->getMessage();
      } 
    
      die();
    }
}

