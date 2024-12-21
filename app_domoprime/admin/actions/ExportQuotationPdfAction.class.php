<?php


class app_domoprime_ExportQuotationPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {              
          $quotation=new DomoprimeQuotation($request->getGetParameter('Quotation'));         
          if ($quotation->isNotLoaded())
             $this->forward404File();  
          if (!$quotation->isOwner() && !$this->getUser()->hasCredential(array(array('superadmin','admin','iso_quotation_owner'))))            
             $this->forwardTo401Action();     
          $this->getEventDispather()->notify(new mfEvent($quotation, 'app_domoprime.quotation.export.pdf'));         
          $model=null;                              
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
         
          if ($request->getGetParameter('debug')=='true')        
              $pdf->output();          
          else
              $pdf->forceOutput();    
         
          if (DomoprimeSettings::load()->get('quotation_archivage')=='YES')
          {             
              $document=new CustomerDocument();
              $document->createDocument($quotation->getContract()->getCustomer(),__("Quotation"),__("Quotation"),$pdf->getFile());                              
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo implode("\n",$messages->getDecodedErrors());
      }          
      die();
    }
}

