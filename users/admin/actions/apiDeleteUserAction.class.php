<?php


class users_apiDeleteUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
      $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
      $messages = mfMessages::getInstance();   
      try 
      {         
          $user=new mfValidatorInteger();
          $user_id=$request->getPostParameter('User');
          $user= new User($user_id,'admin');
          if ($user->isLoaded() )
          {    
            $user->disable();                     
            $this->getEventDispather()->notify(new mfEvent($user, 'user.change','delete')); 
            $response = array("status"=>"OK","action"=>"deleteUser","id" =>$user->get('id'));
          }
          else{
                $response['errors']=__('User is invalid.');
          } 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
    

}
