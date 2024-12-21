<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAssetNewForm.class.php";

class app_domoprime_ajaxNewAssetForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;
         $this->form= new DomoprimeAssetNewForm($request->getPostParameter('DomoprimeAsset'));
         $this->asset=new DomoprimeAsset();
         if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeAsset'))     
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeAsset'));
        if ($this->form->isValid())
        {
            //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
            $this->asset->create($this->contract,$this->form,$this->getUser()->getGuardUser());
            $messages->addInfo(__('Asset has been created.'));
            $request->addRequestParameter('contract', $this->contract);
            $this->forward($this->getModuleName(), 'ajaxListPartialAssetForContract');
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
          //  echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
        }   
    }

}
