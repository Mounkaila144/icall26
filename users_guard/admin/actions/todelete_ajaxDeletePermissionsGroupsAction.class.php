<?php

class users_guard_ajaxDeletePermissionsGroupsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);             
      try 
      {
          $permissions_group=new mfValidatorInteger();
          $permissions_group_id=$permissions_group->isValid($request->getPostParameter('PermissionsGroup'));
          $permissions_group= new PermissionGroup($permissions_group_id,$site);
          $permissions_group->delete();
          $response = array("action"=>"deletePermissionsGroups",
                            "info"=>__('Permissions group has been deleted.'),
                            "id" =>$permissions_group_id); 
      }      
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

