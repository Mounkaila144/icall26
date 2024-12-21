<?php


class customers_ajaxDeleteAvatarAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {          
            $item=$this->getUser()->getGuardUser();
            $item->deleteAvatar();             
            $response = array("action"=>"DeleteAvatar");       
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
