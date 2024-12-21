<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/SignContract

require_once __DIR__.'/../locales/Api/v2/Forms/CustomerContractSignApi2Form.class.php';
 
class customers_contracts_api2SignContractAction extends mfAction {    
    
    function execute(mfWebRequest $request){
        /*$this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                        ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                        ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');*/
        if (!$this->getUser()->hasCredential([['superadmin','api2_contract_sign']]))
             $this->forwardTo401Action();        
        $messages = mfMessages::getInstance();
        $response=new mfArray();        
        if (!$request->isMethod('POST') && !$request->getPostParameters())
            return array('errors'=>'parameters are empty');
        $form = new CustomerContractSignApi2Form($request->getPostParameters());
        $form->bind($request->getPostParameters());
        if($form->isValid()){
            $form->getContract()->save();
            $response = array("contract_id"=>$form->getContract()->get('id'),"opc_at"=>$form->getContract()->get('opc_at'));
        }
        else{
           return array('errors'=>$form->getErrorSchema()->getErrorsMessage());
        }
        return $messages->hasMessages('error') ? array("error" => $messages->getDecodedErrors()) : $response;
    }
}
