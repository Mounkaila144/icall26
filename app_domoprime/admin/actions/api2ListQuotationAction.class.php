<?php
// www.ecosol16.net/admin/api/v2/applications/iso/admin/ListQuotation


require_once __DIR__."/../locales/Api/v2/DomoprimeQuotationListFormatterApi2.class.php";

class app_domoprime_api2ListQuotationAction extends mfAction {

    function execute(mfWebRequest $request) {        
    $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        $messages = mfMessages::getInstance();                                
         if (!$this->getUser()->hasCredential([['superadmin','api_v2_app_domoprime_quotation_list']]))
             $this->forwardTo401Action ();
         try 
      {        
          $data = new DomoprimeQuotationListFormatterApi2($this);         
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$data->getData()->toArray();
    }

}