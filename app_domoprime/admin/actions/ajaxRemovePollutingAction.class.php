<?php


class app_domoprime_ajaxRemovePollutingAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
           
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Polluting'));          
          $item= new DomoprimePollutingCompany($id);     
          $this->getEventDispather()->notify(new mfEvent( $item, 'partner.polluter.delete'));  
           
          $item->delete();              
          $response = array("action"=>"RemovePolluting","id" =>$id,"info"=>__("Polluting has been removed."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
