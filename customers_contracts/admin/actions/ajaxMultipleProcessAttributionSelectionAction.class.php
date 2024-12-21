<?php

require_once __DIR__."/../locales/Forms/AttributionsMultipleForm.class.php";

class customers_contracts_ajaxMultipleProcessAttributionSelectionAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();     
      $this->attributions_form=new AttributionsMultipleForm($this->getUser(),null,$request->getPostParameter('MultipleContractSelection'));
      $this->attributions_form->bind($request->getPostParameter('MultipleContractSelection'));
      if ($this->attributions_form->isValid())
      {          
          $multiple=new CustomerContractAttributeMultipleProcess($this->attributions_form->getActions(),$this->attributions_form->getSelection(),$this->attributions_form->getValues(),$this->getUser());
          $multiple->process();       
          $messages->addInfos($multiple->getMessages());         
          $messages->addErrors($multiple->getErrors()); 
          $messages->addInfo(__("Attributions have been updated."));
      }   
      else
      {
        // var_dump($this->attributions_form->getErrorSchema()->getErrorsMessage());
          $messages->addError(__("Form has some errors."));
      }    
    }
    
}
