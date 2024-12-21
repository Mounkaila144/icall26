<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLayerContactViewForm.class.php";
 

class partners_layer_ajaxViewPartnerContactAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();     
        $this->item = new PartnerLayerContact($request->getPostParameter('PartnerLayerContact')); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('partners_layer','ajaxListPartialLayerCompany');
        }
        $this->form = new PartnerLayerContactViewForm();       
    }

}
