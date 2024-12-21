<?php


class app_domoprime_iso_ExportDocumentsPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
           $contract=new CustomerContract($request->getGetParameter(__('Contract'))) ;                          
           if ($contract->isNotLoaded())
               throw new mfException(__('Contract is invalid.'));
            if (!$contract->isOwner() && !$this->getUser()->hasCredential(array(array('superadmin','admin','iso_documents_owner'))))            
             $this->forwardTo401Action();   
            
           $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.iso.documents.preprocess')); 
         //  if ($contract->isHold())
         //      throw new mfException(__('Contract is hold.')); 
           $generator=new DomoprimeIsoDocumentsGenerator($contract, $this->getUser());
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

