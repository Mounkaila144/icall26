<?php


class app_domoprime_ExportPreMeetingDocumentDocAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try       
      {           
          $contract=new CustomerContract($request->getGetParameter('Contract'));         
          if ($contract->isNotLoaded())
             throw new mfException(__("Contract is invalid."));
          $model = new PartnerPolluterModel('doc');
          
          if ($model->isNotLoaded())
              throw new mfException(__("Model is invalid."));       
          if (!$model->getI18n()->hasFile())
              throw new mfException(__("Model not exist."));      
           if (!$model->getI18n()->isDocx())
              throw new mfException(__("Model not supported."));      
          //   if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('²²'))
          //       throw new mfException(__('Resource PDFtk not available'));             
             $document=new DomoprimePreMeetingDocumentDoc($contract,$model);
             $document->save(); 
             
             if ($request->getGetParameter('debug')=='docx')
             {              
                ob_start();
                ob_end_clean();          
                $response=$this->getResponse();    
                $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
                $response->setHttpHeader("Content-disposition","inline; filename=".$document->getDocx()->getName());   
                $response->sendHttpHeaders();  
                $response->sendFile($document->getDocx()->getFile()); 
                die();
             }
              ob_start();
             ob_end_clean();          
             $response=$this->getResponse();    
             $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
             $response->setHttpHeader("Content-disposition","inline; filename=".$document->getPdf()->getName());     
             $response->sendHttpHeaders();  
             $response->sendFile($document->getPdf()->getFile());                
                             
      } 
      catch (mfException $e) {
          echo $e->getMessage();
      } 
    
      die();
    }
}

