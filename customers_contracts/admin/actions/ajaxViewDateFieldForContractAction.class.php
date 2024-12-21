<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerContractEditDateFieldForm.class.php";

class customers_contracts_ajaxViewDateFieldForContractAction extends mfAction {
     
    public function execute(\mfWebRequest $request) {
      $messages = mfMessages::getInstance();
      $this->form=new CustomerContractEditDateFieldForm();
      $this->form->bind($request->getRequestParameter('values',$request->getPostParameter('CustomerContractDatesField')));      
      if (!$this->form->isValid()) 
      {                   
          $this->getController()->setRenderMode(mfView::RENDER_JSON);          
          return array('error'=>$messages->getDecodedErrors());
      }    
    }
}
