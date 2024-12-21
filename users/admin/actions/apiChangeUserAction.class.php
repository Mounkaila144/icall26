<?php
// www.ecosol28.net/admin/api/users/admin/SaveNewUser

class users_apiChangeUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $response=array();
        $messages = mfMessages::getInstance();     
        try 
        {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
            if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_change'))))
                $this->forwardTo401Action();
            $param=$request->getPostParameter('User');
            $user=new User($param['id'],'admin'); 
                if ($user->isLoaded()) 
                {
                    $user->set('is_active',$param['value']);
                    $user->save();
                    $this->getEventDispather()->notify(new mfEvent($user, 'user.change','validate')); 
                    $response = array("action"=>"ChangeUser","id"=>$param['id'],"state" =>$param['value']);
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
