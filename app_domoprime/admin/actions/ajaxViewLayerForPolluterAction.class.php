<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterLayerViewForm.class.php';

class app_domoprime_ajaxViewLayerForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
       $messages = mfMessages::getInstance();           
       $this->item = new PartnerPolluterCompany($request->getPostParameter('Polluter'));         
       if ($this->item->isNotLoaded())
           return ;
       $this->form = new DomoprimePolluterLayerViewForm();     
    }
}

