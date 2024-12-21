<?php


class app_domoprime_ExportExtendedPolluterAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $polluter=new DomoprimePollutingCompany($request->getGetParameter('Polluter'));         
          if ($polluter->isNotLoaded())      
              throw new mfException(__('Polluter is invalid.'));
          $archive= new PartnerPolluterCompanyExtendedArchive($polluter);
          $archive->process();
          $response=$this->getResponse();      
          $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
          $response->setHttpHeader('Content-disposition: filename="'.$archive->getName().'"');     
          $response->sendFile($archive->getFilename());       
          
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}

