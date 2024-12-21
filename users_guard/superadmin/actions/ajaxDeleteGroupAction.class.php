<?php

class users_guard_ajaxDeleteGroupAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
          $group=new mfValidatorInteger();
          $group_id=$group->isValid($request->getPostParameter('Group'));
          $group= new Group($group_id,array('frontend','admin'),$site);
          $group->delete();          
          $response = array("action"=>"deleteGroup","id" =>$group_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

