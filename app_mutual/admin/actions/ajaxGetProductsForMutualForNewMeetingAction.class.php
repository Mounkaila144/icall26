<?php

class app_mutual_ajaxGetProductsForMutualForNewMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {   
            $mutual = new MutualPartner($request->getPostParameter('MutualPartner'));
            if($mutual->isNotLoaded())
                throw new mfException("Mutual is not loaded");
            
            $products = MutualProduct::getProductsForMutual($mutual);
            $response = array("action"=>"GetProductsForMutualForNewMeeting","items"=>$products->toArray(),"mutual"=>$mutual->get('id'));                        
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

