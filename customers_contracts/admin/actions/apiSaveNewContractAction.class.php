<?php
// www.ecosol28.net/admin/api/users/admin/SaveNewUser
require_once __DIR__."/../locales/Api/Forms/ContractApiNewForm.class.php";
require_once __DIR__."/../locales/Api/ContractSaveNewFormatterApi.class.php";

class customers_contracts_apiSaveNewContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();        
      //  $form = new ContractApiNewForm($this->getUser());           
     //   $item=new CustomerContract($request->getPostParameter('Contract'));                   
     //   $form->bind($request->getPostParameter('Contract'));           
        $data = new ContractSaveNewFormatterApi($request->getPostParameter('Contract'),$this->getUser());               
        return $data->toArray();
    }

}
