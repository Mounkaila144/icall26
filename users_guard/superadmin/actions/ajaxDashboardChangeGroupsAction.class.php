<?php

class users_guard_ajaxDashboardChangeGroupsAction extends mfAction {
    
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $form=new changeGroupsForm($request->getPostParameter('groups'));
          $form->bind($request->getPostParameter('groups'));
          if ($form->isValid())
          {    
            $users= new GroupCollection($form->getValue('groups'));   
            $users->save();
            $this->getEventDispather()->notify(new mfEvent($users, 'groups.change','change')); 
            $response = array("action"=>"ChangeGroups",
                            "state" =>$form->getValue('value'),
                            "selection" =>$form->getValue('selection')
                           );
          }
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      $response=$messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
      return $response;
    }

}

