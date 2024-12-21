<?php

class app_mutual_ajaxDisabledStatusMutualProductDecommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $decommission = new MutualProductDecommission($validator->isValid($request->getPostParameter('MutualProductDecommission')));
            if ($decommission->isLoaded())
            {    
                $decommission->set('status','DELETE');
                $decommission->save();
                $response = array("action"=>"DisableMutualProductDecommission","id" =>$decommission->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
