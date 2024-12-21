<?php


class customers_meetings_ajaxCopyMeetingAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
      $messages = mfMessages::getInstance();
      try 
      {                 
       //   if (!$this->getUser()->hasCredential(array(array('superadmin','meeting_copy'))))
       //         $this->forwardTo401Action ();
         $item=new CustomerMeeting($request->getPostParameter('Meeting'));
         if ($item->isNotLoaded())
            throw new mfException(__("Meeting is invalid."));
        $copy=$item->copy();
          $this->getEventDispather()->notify(new mfEvent($copy, 'meeting.copy',array('source'=>$item)));                                                                 
         $messages->addInfo(__("Meeting has been copied."));     
         $request->addRequestParameter('meeting', $copy);
         $this->forward($this->getModuleName(), 'ajaxViewMeeting');
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
       $this->getController()->setRenderMode(mfView::RENDER_JSON);
       $response = array("action"=>"CopyMeeting",
                         "id" =>$item->get('id'));
       return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

