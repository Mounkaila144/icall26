<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/GetContract
 
class customers_contracts_api2GetcontractAction extends mfAction {    
    
    function execute(mfWebRequest $request){
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential([['superadmin','api2_contract_get']]))
             $this->forwardTo401Action();
        $response=new mfArray();        
        $item=new CustomerContract($request->getGetAndPostParameter('id'));  
      
        if ($item->isNotLoaded())
            return $response->set('error','contract is invalid')->toArray();        
        if (!$item->isAuthorized('view'))
            $this->forwardTo401Action();                 
        $response->set('data',$item->getFormatter()->toArrayForApi2());
        return $response->toArray();
    }
}
