<?php

class app_mutual_ajaxDisabledStatusMutualProductAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $product = new MutualProduct($validator->isValid($request->getPostParameter('MutualProduct')));
            if ($product->isLoaded())
            {    
                $product->set('status','DELETE');
                $product->save();
                $response = array("action"=>"DisableMutualProduct","id" =>$product->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
