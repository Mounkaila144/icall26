<?php


require_once dirname(__FILE__)."/../locales/Forms/AutoSaveContractForm.class.php";

class customers_contracts_ajaxAutoSaveContractForViewContractAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $form=new AutoSaveContractForm($this->getUser(),$request->getPostParameter('AutoSaveField'));
          $form->bind($request->getPostParameter('AutoSaveField'));
          if (!$form->isValid())          
          {
             // var_dump($form->getErrorSchema()->getErrorsMessage());
              throw new mfException(__('Form has some errors.'));          
          }   
          $form->process();
          $this->getEventDispather()->notify(new mfEvent($form, 'contract.field.autosave'));  
          $messages->addInfo(__("Field [%s] has been updated.",$form->getFieldI18n()));
          $response = array("action"=>"AutoSaveRequest",
                            "info"=>$messages->getDecodedInfos());
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
