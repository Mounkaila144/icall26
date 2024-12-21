<?php

require_once __DIR__."/../locales/Forms/DomoprimeZoneFromPostcodeForm.class.php";

class app_domoprime_ajaxGetZoneFromPostcodeAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
          $form=new  DomoprimeZoneFromPostcodeForm();
          $form->bind($request->getPostParameter('ZoneFromPostcode'));
          if ($form->isValid())
          {    
            $zone=$form->getZone();
            if ($zone->isLoaded())
                $response = array("action"=>"GetZoneFromPostcode","zone"=>$zone->getSector()->get('name'));
            else
                $response = array("action"=>"GetZoneFromPostcode","zone"=>__('----'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
