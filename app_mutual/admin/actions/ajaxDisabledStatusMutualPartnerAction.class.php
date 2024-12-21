<?php

class app_mutual_ajaxDisabledStatusMutualPartnerAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $mutual = new MutualPartner($validator->isValid($request->getPostParameter('MutualPartner')));
            if ($mutual->isLoaded())
            {    
                $mutual->set('status','DELETE');
                $mutual->save();
                $response = array("action"=>"DisableMutualPartner","id" =>$mutual->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
