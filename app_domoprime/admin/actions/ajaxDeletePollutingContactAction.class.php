<?php


class app_domoprime_ajaxDeletePollutingContactAction extends mfAction{
    
    function execute(mfWebRequest $request){
      
        $messages = mfMessages::getInstance();   
        try 
        {        
            $item=new mfValidatorInteger();
            $id=$item->isValid($request->getPostParameter('PollutingContact'));          
            $item= new DomoprimePollutingContact($id);           
            $item->delete();              
            $response = array("action"=>"DeletePollutingContact","id" =>$id,"info"=>__("contact has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
   
}
