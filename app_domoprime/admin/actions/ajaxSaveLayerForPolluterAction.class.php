<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterLayerViewForm.class.php';

class app_domoprime_ajaxSaveLayerForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
       $messages = mfMessages::getInstance();           
       $this->item = new PartnerPolluterCompany($request->getPostParameter('PolluterLayer'));         
       if ($this->item->isNotLoaded())
           return ;     
       $this->form = new DomoprimePolluterLayerViewForm();  
       $this->form->bind($request->getPostParameter('PolluterLayer'));
       if ($this->form->isValid())
       {         
            $this->item->add($this->form->getValues())->save();
            $messages->addInfo(__("Layer has been updated.")); 
            $this->forward($this->getModuleName(), 'ajaxListPartialPollutingCompany');
       }   
       else
       {
           $messages->addError(__("Form has some errors."));
       }    
    }
}

