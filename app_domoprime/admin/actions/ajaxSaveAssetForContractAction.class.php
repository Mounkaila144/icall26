<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAssetViewForm.class.php";

class app_domoprime_ajaxSaveAssetForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;
         $this->form= new DomoprimeAssetViewForm();    
         $this->item=new DomoprimeAsset($request->getPostParameter('DomoprimeAsset'));
         if ($this->item->isNotLoaded() || !$request->getPostParameter('DomoprimeAsset'))
             return ;
        $this->form->bind($request->getPostParameter('DomoprimeAsset'));
        if ($this->form->isValid())
        {
            //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
            $this->item->add($this->form->getValues());
            $this->item->save();
            $messages->addInfo(__('Asset has been updated.'));
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
