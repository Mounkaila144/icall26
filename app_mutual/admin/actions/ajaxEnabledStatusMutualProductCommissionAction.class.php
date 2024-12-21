<?php

class app_mutual_ajaxEnabledStatusMutualProductCommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $commission = new MutualProductCommission($validator->isValid($request->getPostParameter('MutualProductCommission')));
            if ($commission->isLoaded())
            {    
                $commission->set('status','ACTIVE');
                $commission->save();
                $response = array("action"=>"EnableMutualProductCommission","id" =>$commission->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
