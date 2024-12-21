<?php

/*
 * Generated by SuperAdmin Generator date : 24/04/13 15:45:29
 */
 
class users_ajaxDeleteAttributionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));    
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('UserAttributionI18n'));          
          $item= new UserAttributionI18n($id,$site);           
          $item->delete();              
          $response = array("action"=>"deleteAttributionI18n","id" =>$id,"info"=>__("Attribution has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
