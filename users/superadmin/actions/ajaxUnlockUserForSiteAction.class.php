<?php

class users_ajaxUnlockUserForSiteAction  extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {
            $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
            $this->forwardIf(!$this->site,"sites","Admin");
            $user = new mfValidatorInteger();
            $user_id = $user->isValid($request->getPostParameter('User'));
            $user = new User($user_id,'admin',$this->site);
            if($user->isNotLoaded())
                throw new mfException(__("The user is not loaded."));
            $user->set('unlocked_by', $this->getUser()->getGuardUser());
            $user->unlockUser();
            $response = array("action"=>"UnlockUserForSite",
                              "state"=>$user->get('is_locked'),
                              "locked_by"=>$user->getUnlockedBy()->getName(),
                              "locked_at"=>"",
                              "number_of_try"=>$user->get('number_of_try'),
                              "status"=>$user->get('is_active'),
                              "id" =>$user->get('id'));             
            $this->getEventDispather()->notify(new mfEvent($user, 'user.unlocked'));            
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}