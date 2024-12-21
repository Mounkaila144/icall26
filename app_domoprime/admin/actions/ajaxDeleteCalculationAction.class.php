<?php


class app_domoprime_ajaxDeleteCalculationAction extends mfAction{
    
    function execute(mfWebRequest $request){
      
        $messages = mfMessages::getInstance();   
        try 
        {        
            $item=new mfValidatorInteger();
            $id=$item->isValid($request->getPostParameter('DomoprimeCalculation'));          
            $item= new DomoprimeCalculation($id);           
         //   $item->delete();              
            $response = array("action"=>"DeleteCalculation","id" =>$id,"info"=>__("Calculation has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
   
}
