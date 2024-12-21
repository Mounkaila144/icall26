<?php

require_once __DIR__."/../locales/Forms/CustomerMeetingStatesAutoSaveForm.class.php";

class customers_meetings_ajaxAutoSaveStatesForMeetingAction extends mfAction {
    
          
   function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $form=new CustomerMeetingStatesAutoSaveForm($this->getUser(),$request->getPostParameter('CustomerMeetingAutoSaveState'));
          $form->bind($request->getPostParameter('CustomerMeetingAutoSaveState'));
          if (!$form->isValid())          
          {
              
              var_dump($form->getErrorSchema()->getErrorsMessage());
              throw new mfException(__('Form has some errors.'));          
          }   
          $form->process();
          $this->getEventDispather()->notify(new mfEvent($form->getMeeting(), 'meeting.change'));  
          $messages->addInfo(__("State %s has been updated.",$form->getFieldI18n()));
          $response = array("action"=>"AutoSaveStateForMeeting",
                            "info"=>$messages->getDecodedInfos());
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
