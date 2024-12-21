<?php


class app_domoprime_ExportDocuments2PdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
           $contract=new CustomerContract($request->getGetParameter(__('Contract'))) ;                          
           if ($contract->isNotLoaded())
               throw new mfException(__('Contract is invalid.'));
         //  if ($contract->isHold())
         //      throw new mfException(__('Contract is hold.')); 
           $generator=new DomoprimeDocumentsGenerator2( $contract, $this->getUser());
           $generator->process();            
              
           $generator->merge(); 
                                
           $response=$this->getResponse();           
           $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
           $response->setHttpHeader('Content-disposition',' inline; filename="'.$generator->getOutputFile().'"');      
           $response->sendFile($generator->getOutputFilename());                                                                        
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}

