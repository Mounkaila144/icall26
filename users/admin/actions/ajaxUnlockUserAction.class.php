<?php

class users_ajaxUnlockUserAction  extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {
            $user = new mfValidatorInteger();
            $user_id = $user->isValid($request->getPostParameter('User'));
            $user = new User($user_id,'admin');
            if($user->isNotLoaded())
                throw new mfException(__("The user is not loaded."));
            $user->set('unlocked_by', $this->getUser()->getGuardUser());
            $user->unlockUser();
            $response = array("action"=>"UnlockUser",
                                "state"=>$user->get('is_locked'),
                                "locked_by"=>$user->getUnlockedBy()->getName(),
                                "locked_at"=>"",
                                "number_of_try"=>$user->get('number_of_try'),
                                "id" =>$user->get('id')); 
            $this->getEventDispather()->notify(new mfEvent($user, 'user.unlocked'));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}