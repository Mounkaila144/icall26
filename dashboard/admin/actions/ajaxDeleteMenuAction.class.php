<?php


class dashboard_ajaxDeleteMenuAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {         
          $validator=new mfValidatorInteger();
          $menu= new SystemMenu(array('id'=>$validator->isValid($request->getPostParameter('SystemMenu'))));
          if ($menu->isLoaded())
          {    
            $menu->disable();
          
            $response = array("action"=>"DeleteMenu","id" =>$menu->get('id'),"info"=>__("Menu has been deleted."));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
