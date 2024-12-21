<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerContractEditDateFieldForm.class.php";

class customers_contracts_ajaxEditDateFieldForContractAction extends mfAction {
     
    public function execute(\mfWebRequest $request) {
      $messages = mfMessages::getInstance();
      $this->form=new CustomerContractEditDateFieldForm();
      $this->form->bind($request->getPostParameter('CustomerContractDatesField'));      
      if (!$this->form->isValid()) 
      {
         //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
          $this->getController()->setRenderMode(mfView::RENDER_JSON);          
          return array('error'=>$messages->getDecodedErrors());
      }    
    }
}
