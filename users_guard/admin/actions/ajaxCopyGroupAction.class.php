<?php


class users_guard_ajaxCopyGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();               
        try 
      {
           if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_copy_group'))))
            $this->forwardTo401Action();
          $group=new Group($request->getPostParameter('id'),'admin') ;
          if ($group->isLoaded())
          {
             $group->copy();
             $this->getEventDispather()->notify(new mfEvent($group,'user.guard.group.copy'));
          }    
          $response = array("action"=>"CopyGroup",                            
                            "info"=>__("Group has been copied."));
      }       
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
