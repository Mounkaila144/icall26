<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListContract

//require_once dirname(__FILE__)."/../locales/Api/FormFilters/CustomerContractApiFormFilter.class.php";
//require_once dirname(__FILE__)."/../locales/Pagers/CustomerContractsPager.class.php";
require_once dirname(__FILE__)."/../locales/Api/v2/CustomerContractListFormatterApi2.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerContractsPager.class.php";

class customers_contracts_api2ListContractAction extends mfAction {

    function execute(mfWebRequest $request) {        
    $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        $messages = mfMessages::getInstance();                                
         if (!$this->getUser()->hasCredential([['superadmin','api2_customer_contract_list']]))
             $this->forwardTo401Action ();
         try 
      {        
          $data = new CustomerContractListFormatterApi2($this);         
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$data->getData()->toARray();
    }

}