<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAssetViewForm.class.php";

class app_domoprime_ajaxViewAssetForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;
         $this->form= new DomoprimeAssetViewForm();    
         $this->item=new DomoprimeAsset($request->getPostParameter('DomoprimeAsset'));
    }

}
