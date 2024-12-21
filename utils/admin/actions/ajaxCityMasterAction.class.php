<?php

class utils_ajaxCityMasterAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {         
            $form=new CityForm();
            $form->bind($request->getPostParameter('City'));
            if ($form->isValid()) 
            {
               $response=CityUtils::getCitySuperAdmin($form->getValues());
            }   
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;      
    }

}

