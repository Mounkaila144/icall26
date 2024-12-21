<?php



class partners_layer_ajaxListPartnerContactAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item=$request->getRequestParameter('PartnerLayer', new PartnerLayerCompany($request->getPostParameter('PartnerLayer'))); 
    }

}
