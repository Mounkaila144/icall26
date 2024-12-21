<?php

class system_debug_ajaxDebugAction extends mfAction {

    
    function execute(mfWebRequest $request) {
      $messages=mfMessages::getInstance(); 
      try 
      {
         if ($this->getUser()->hasCredential(array(array('superadmin_debug'))))
         {
             $this->getUser()->removeCredential('superadmin_debug');
             $response = array("text"=>__("Debug Off."),"debug"=>"NO","action"=>"Debug");   
         }
         else
         {
             $this->getUser()->addCredential('superadmin_debug');
             $response = array("text"=>__("Debug On."),"debug"=>"YES","action"=>"Debug");   
         }    
            
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response; 
    }

}

