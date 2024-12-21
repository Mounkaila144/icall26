<?php


require_once dirname(__FILE__)."/../locales/Forms/AutoSaveMeetingForm.class.php";

class customers_meetings_ajaxAutoSaveMeetingForViewMeetingAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $form=new AutoSaveMeetingForm($this->getUser(),$request->getPostParameter('AutoSaveField'));
          $form->bind($request->getPostParameter('AutoSaveField'));
          if (!$form->isValid())          
          {
            //  var_dump($form->getErrorSchema()->getErrorsMessage());
              throw new mfException(__('Form has some errors.'));          
          }   
          $form->process();
          $this->getEventDispather()->notify(new mfEvent($form->getMeeting(), 'meeting.change',array('action'=>'autosave')));  
          $messages->addInfo(__("Field [%s] has been updated.",$form->getFieldI18n()));
          $response = array("action"=>"AutoSaveRequest",
                            "info"=>implode(",",$messages->getDecodedInfos()));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
