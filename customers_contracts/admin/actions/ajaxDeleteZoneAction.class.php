<?php


class customers_contracts_ajaxDeleteZoneAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        $messages= mfMessages::getInstance();
        try 
        {         
            $item=new mfValidatorInteger();
            $id=$item->isValid($request->getPostParameter('CustomerContractZone'));          
            $item= new CustomerContractZone($id);           
            $item->delete();              
            $response = array("action"=>"DeleteZone","id" =>$id,"info"=>__("Zone has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        
    }

}
