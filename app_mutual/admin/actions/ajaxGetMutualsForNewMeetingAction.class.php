<?php

class app_mutual_ajaxGetMutualsForNewMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {   
            
            $mutuals = MutualPartner::getMutualsForSelect();
            $response = array("action"=>"GetMutualsForNewMeeting","items"=>$mutuals->toArray());                        
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

