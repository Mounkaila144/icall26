<?php

// www.ecosol16.net/admin/api/v2/applications/iso/admin/SignQuotation

require_once __DIR__.'/../locales/Api/v2/Forms/DomoprimeQuotationSignApi2Form.class.php';
 
class app_domoprime_api2SignQuotationAction extends mfAction {    
    
    function execute(mfWebRequest $request){
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                        ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                        ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential([['superadmin','api2_quotation_sign']]))
             $this->forwardTo401Action();        
        $messages = mfMessages::getInstance();
        $response=new mfArray();        
        if (!$request->isMethod('POST') && !$request->getPostParameters())
            return array('errors'=>'parameters are empty');
        $form = new DomoprimeQuotationSignApi2Form($request->getPostParameters());
        $form->bind($request->getPostParameters());
        if($form->isValid()){
            $form->getQuotation()->save();
            $response = array("quotation_id"=>$form->getQuotation()->get('id'),"signed_at"=>$form->getQuotation()->get('signed_at'));
        }
        else{
           return array('errors'=>$form->getErrorSchema()->getErrorsMessage());
        }
        return $messages->hasMessages('error') ? array("error" => $messages->getDecodedErrors()) : $response;
    }

}
