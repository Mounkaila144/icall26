<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeRegionPriceForClassForm.class.php";

class app_domoprime_ajaxViewRegionPriceForClassAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                  
        $this->form= new DomoprimeRegionPriceForClassForm();
        $this->item=new DomoprimeClassRegionPrice($request->getPostParameter('DomoprimeRegionPriceClass'));         
    }

}
