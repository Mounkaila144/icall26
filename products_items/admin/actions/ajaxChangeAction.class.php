<?php

class products_items_ajaxChangeAction extends mfAction {
    
    
     
    function execute(mfWebRequest $request) {       
      $messages = mfMessages::getInstance();   
      try 
      {         
          $val=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $id=$val->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $item= new ProductItem($id);         
          if ($item->isLoaded()) 
          {    
              $item->set('is_active',$value);
              $item->save();
              $response = array("action"=>"ChangeItem","id"=>$id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

