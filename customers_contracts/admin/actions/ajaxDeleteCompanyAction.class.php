<?php


class customers_contracts_ajaxDeleteCompanyAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        $messages= mfMessages::getInstance();
        try 
        {         
            $item=new mfValidatorInteger();
            $id=$item->isValid($request->getPostParameter('CustomerContractCompany'));          
            $item= new CustomerContractCompany($id);           
            $item->delete();              
            $response = array("action"=>"DeleteCompany","id" =>$id,"info"=>__("Company has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        
    }

}
