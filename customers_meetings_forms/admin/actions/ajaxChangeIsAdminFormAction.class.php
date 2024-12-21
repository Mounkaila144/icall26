<?php

class customers_meetings_forms_ajaxChangeIsAdminFormAction extends mfAction {
    
    
     
    function execute(mfWebRequest $request) {       
      $messages = mfMessages::getInstance(); 
            if (!$this->getUser()->hasCredential(array(array('superadmin','settings_meeting_form_list_admin'))))
            $this->forwardTo401Action();
      try 
      {         
          $user=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $id=$user->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"N":"Y";
          $meeting_form= new CustomerMeetingForm($id);         
          if ($meeting_form->isNotLoaded()) 
            throw new mfException(__('Form is invalid.'));
        $meeting_form->set('is_admin',$value)->save();          
        $response = array("action"=>"ChangeIsAdminForm","id"=>$meeting_form->get('id'),"state" =>$value);
       
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

