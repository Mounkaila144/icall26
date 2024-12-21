<?php


require_once dirname(__FILE__)."/../locales/Forms/AutoSaveRequestForm.class.php";

class app_domoprime_iso_ajaxAutoSaveRequestForViewContractAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $form=new AutoSaveRequestForm($request->getPostParameter('AutoSaveField'));
          $form->bind($request->getPostParameter('AutoSaveField'));
          if (!$form->isValid())          
          {
            //  var_dump($form->getErrorSchema()->getErrorsMessage());
              throw new mfException(__('Form has some errors.'));          
          }   
          $form->process();
          $response = array("action"=>"AutoSaveRequest",
                            "info"=>__("Field [%s] has been updated.",$form->getFieldI18n()));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
