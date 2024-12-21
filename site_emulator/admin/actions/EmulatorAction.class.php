<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCommentViewForm.class.php";



class site_emulator_EmulatorAction extends mfAction {    
    
    function execute(mfWebRequest $request) {
        
      $messages = mfMessages::getInstance();
      try 
      {         
        $messages = mfMessages::getInstance();        
        $this->user=$this->getUser();
        $this->item=new User((int)$request->getPostParameter('User'),'admin');  
        $this->user_settings=  UserSettings::load(); 
             $response = array("action"=>"Emulator",
                             ($request->getPostParameter('User') && $this->item->isLoaded())?array("data" =>array("action"=> "Emulator", "Username"=> $this->item->get('username'))):array("error" =>__("Post parameters invalid.")) 
                          );
             
       } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
