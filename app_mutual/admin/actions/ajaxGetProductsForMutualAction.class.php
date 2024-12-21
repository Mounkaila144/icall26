<?php

class app_mutual_ajaxGetProductsForMutualAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {   
            $meeting = new CustomerMeeting($request->getPostParameter('Meeting'));
            if($meeting->isNotLoaded())
                throw new mfException("Meetin is not loaded");
            $mutual = new MutualPartner($request->getPostParameter('MutualPartner'));
            $products = MutualProduct::getUnselectedProductsForMeeting($mutual,$meeting);
            $response = array("action"=>"GetProductsForMutual","items"=>$products->toArray(),"mutual"=>$mutual->get('id'),"meeting_id"=>$meeting->get('id'));                        
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

