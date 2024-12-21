<?php


class app_domoprime_ExportPolluterAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $polluter=new DomoprimePollutingCompany($request->getGetParameter('Polluter'));         
          if ($polluter->isNotLoaded())      
              throw new mfException(__('Polluter is invalid.'));
          $archive= new PartnerPolluterCompanyArchive($polluter);
          $archive->process();
          $response=$this->getResponse();    
          $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
        //  $response->setHeaderFile($archive->getFilename());
          $response->setHttpHeader('Content-disposition: filename="'.$archive->getName().'"');     
        //  $response->sendHttpHeaders();
          $response->sendFile($archive->getFilename(),0,0);                                
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}

