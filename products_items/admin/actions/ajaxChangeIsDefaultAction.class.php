<?php

class products_items_ajaxChangeIsDefaultAction extends mfAction {
    
    
     
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
              $item->set('is_default',$value);
              $item->save();
              $response = array("action"=>"ChangeIsDefault",
                                "info"=>__("Default has been changed."),
                                "id"=>$id,"is_default" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

