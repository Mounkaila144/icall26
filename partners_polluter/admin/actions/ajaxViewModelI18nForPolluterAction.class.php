<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelForPolluterForm.class.php";
 
class partners_polluter_ajaxViewModelI18nForPolluterAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new PartnerPolluterModelForPolluterForm();
        $this->item_i18n=new PartnerPolluterModelI18n($request->getPostParameter('PolluterModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

