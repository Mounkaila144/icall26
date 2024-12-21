<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelPdfViewForPolluterForm.class.php";
 
class partners_polluter_ajaxViewPDFModelI18nForPolluterAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new PartnerPolluterModelPdfViewForPolluterForm();
        $this->item_i18n=new PartnerPolluterModelI18n($request->getPostParameter('PolluterModelI18n'));    
        $this->user=$this->getUser();               
   }

}

