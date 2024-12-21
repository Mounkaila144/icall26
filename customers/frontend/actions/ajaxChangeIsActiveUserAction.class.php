<?php


class customers_ajaxChangeIsActiveUserAction extends mfAction {
    
    
        
     function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {        
          $form=new ChangeForm();
          $form->bind($request->getPostParameter('CustomerUser'));
          if ($form->isValid())
          {
             $item= new CustomerUser($form->getValue('id'));    
             if ($item->isLoaded() && !$item->isAdmin())
             {  
                $value=((string)$form['value']=='YES')?"NO":"YES"; 
                $item->set('is_active',$value);
                $item->save();                
                $response = array("action"=>"ChangeIsActiveUser","id"=>$item->get('id'),"state" =>$value);
             }
          }                          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


