<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterPropertyViewForm.class.php';

class app_domoprime_ajaxViewPropertiesForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
       $messages = mfMessages::getInstance();           
       $this->polluter = new PartnerPolluterCompany($request->getPostParameter('Polluter'));         
       if ($this->polluter->isNotLoaded())
           return ;
       $this->form = new DomoprimePolluterPropertyViewForm(); 
       $this->item=new DomoprimePolluterProperty($this->polluter);
    }
}

