<?php


class app_domoprime_ExportQuotationPdf2Action extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();         
      try 
      {                       
          $quotation=new DomoprimeQuotation($request->getGetParameter('Quotation'));         
          if ($quotation->isNotLoaded())
             $this->forward404File();  
          if (!$quotation->isOwner() && !$this->getUser()->hasCredential(array(array('superadmin','admin','iso_quotation_owner'))))            
             $this->forwardTo401Action();       
          $model=null;
          $settings=new DomoprimeSettings();
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
            $model=$settings->getModelForQuotation();     
          }         
          if ($model->isNotLoaded())
              throw new mfException( __("Model is invalid."));  
          
       //   $time_start= microtime(true);
          $pdf=new DomoprimeQuotationPDF2($model,$quotation);          
          if ($request->getGetParameter('debug')=='true')
              $pdf->output();
          else
              $pdf->forceOutput();   
          
       /*   $response=$this->getResponse();    
          $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
          $response->setHttpHeader('Content-disposition: filename="'.$pdf->getName().'"');   */  
        //  $response->sendFile($pdf->getFilename());   
         /* if ($settings->get('quotation_archivage')=='YES')
          {             
              $document=new CustomerDocument();
              $document->createDocument($quotation->getContract()->getCustomer(),__("Quotation"),__("Quotation"),$pdf->getFile());                              
          }*/
      } 
      catch (mfException $e) {
          $messages->addError($e);
      } 
    //  var_dump($messages->getDecodedErrors());
      
    /*  $time=(microtime(true) - $time_start);
      
      $file=new File(mfConfig::get('mf_site_cache_dir')."/debug_pdf2.txt");
      $file->putContent("Time=".$time);*/
      die();
    }
}

