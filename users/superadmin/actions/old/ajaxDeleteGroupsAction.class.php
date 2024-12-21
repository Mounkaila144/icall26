<?php

class users_ajaxDeleteGroupsAction extends mfAction {
     
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
         $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site) 
              throw new mfException(__("thanks to select a site"));  
         $user=new user($request->getPostParameter('user'),'admin',$site);
         if ($user->isLoaded())
         {    
             $userGroupsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => userGroupUtils::getGroupsUserbyUserList($user))), count($request->getPostParameter('selection')));
             $userGroupsValidator->isValid($request->getPostParameter('selection'));        
             $userGroups= new userGroupCollection($request->getPostParameter('selection'),'admin',$site);
             $userGroups->delete();          
             $response = array("action"=>"deleteUserGroups","parameters" =>$request->getPostParameter('selection'));
         }
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

