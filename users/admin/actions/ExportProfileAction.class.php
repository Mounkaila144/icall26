<?php

class users_ExportProfileAction extends mfAction{
   
    function execute(mfWebRequest $request) {            
      try 
      {  
          $profile=new UserProfile($request->getGetParameter('Profile'));         
          if ($profile->isNotLoaded())
              throw new mfException(__('Profile is invalid.'));
          
          $xml=new UserProfileXML($profile);
          $xml->save();
           
        $response=$this->getResponse();                                
        $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
        $response->setHeaderFile($xml->getFilename(),true);            
        $response->sendHttpHeaders();     
        ob_start();
        ob_end_clean();  
        ob_end_flush();
        readfile($xml->getFilename());  
      } 
      catch (mfException $e) {
         echo $e->getMessage();
      } 
      die();
    }
    

}
