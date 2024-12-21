<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerContractDateFieldForm.class.php";

class customers_contracts_ajaxSaveDateFieldForContractAction extends mfAction {
     
    public function execute(\mfWebRequest $request) {
      $messages = mfMessages::getInstance();
      $this->form=new CustomerContractDateFieldForm();
      $this->form->bind($request->getPostParameter('CustomerContractDatesField'));      
      if (!$this->form->isValid()) 
      {          
         // echo "Save="; var_dump($this->form->getErrorSchema()->getErrorsMessage());
          $this->getController()->setRenderMode(mfView::RENDER_JSON);          
          return array('error'=>$this->form->getErrorSchema()->getErrorsMessage());
      }               
      $this->form->getContract()->save();           
      $request->addRequestParameter('values', $this->form->getValuesForView());
      $this->forward($this->getModuleName(), 'ajaxViewDateFieldForContract');
    }
}
