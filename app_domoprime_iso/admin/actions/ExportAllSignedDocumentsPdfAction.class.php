<?php


class app_domoprime_iso_ExportAllSignedDocumentsPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
           $contract=new CustomerContract($request->getGetParameter('contract')) ;                          
           if ($contract->isNotLoaded())
               throw new mfException(__('Contract is invalid.'));
           $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.iso.signed_documents.preprocess')); 
         //  if (!$contract->isOwner() && !$this->getUser()->hasCredential(array(array('superadmin','iso_documents_owner'))))            
       //       $this->forwardTo401Action();   
           if (!mfModule::isModuleInstalled('app_domoprime_yousign_evidence'))
               $this->forwardTo401Action();   
           $generator=new DomoprimeIsoDocumentsGenerator3($contract, $this->getUser());
           $generator->process();            
              
           $generator->merge(); 
                                
           $response=$this->getResponse();           
           $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
           $response->setHttpHeader('Content-disposition',' inline; filename='.$generator->getOutputFile());      
           $response->sendFile($generator->getOutputFilename(),0,0);                                                                        
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}

