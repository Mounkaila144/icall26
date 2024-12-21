<?php



require_once dirname(__FILE__)."/../locales/Forms/UserApiForm.class.php";

class users_ViewUserApiAction extends mfAction {
   
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();              
        $item=new User($request->getPostParameter('User'),'admin');  
        $form = new UserApiForm($this->getUser());      
        //$this->user_settings=  UserSettings::load();
       try{
        $data = new UserFormatterViewApi($item,$form);
        $response = array("action"=>"Emulator",
                             ($request->getPostParameter('User') && $item->isLoaded())?array("data" =>$data->getData()->toArray()):array("error" =>__("Post parameters invalid.")) 
                          );
             
       } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
        
       
    }

}

 