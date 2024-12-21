<?php
require_once dirname(__FILE__).'/../locales/Forms/PartnerLayerCompanyViewForm.class.php';

class partners_layer_ajaxViewLayerCompanyAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->item = new PartnerLayerCompany($request->getPostParameter('PartnerLayer')); // new object       
        $this->form = new PartnerLayerCompanyViewForm(); 
    }
    
}
