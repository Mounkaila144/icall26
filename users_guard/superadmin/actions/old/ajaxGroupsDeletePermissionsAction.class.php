<?php

class userGuard_ajaxGroupsDeletePermissionsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
      $this->forwardIf(!$site,"sites","ajaxAdmin"); 
      try 
      {
         $group=new Group($request->getPostParameter('group'),array('admin','frontend'),$site);
         $groupPermissionsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => groupPermissionUtils::getPermissionsGroupbyGroupList($group,$group->get('application'),$site))), count($request->getPostParameter('selection')));
         $groupPermissionsValidator->isValid($request->getPostParameter('selection'));        
         $groupPermissions= new groupPermissionCollection($request->getPostParameter('selection'),$group->get('application'),$site);
         $groupPermissions->delete();          
         $response = array("action"=>"deletePermissions","parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

