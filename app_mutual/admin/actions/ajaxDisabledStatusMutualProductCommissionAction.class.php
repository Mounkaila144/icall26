<?php

class app_mutual_ajaxDisabledStatusMutualProductCommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $commission = new MutualProductCommission($validator->isValid($request->getPostParameter('MutualProductCommission')));
            if ($commission->isLoaded())
            {    
                $commission->set('status','DELETE');
                $commission->save();
                $response = array("action"=>"DisableMutualProductCommission","id" =>$commission->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
