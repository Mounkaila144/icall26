<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSectorEnergyPriceForProductForm.class.php";

class app_domoprime_ajaxViewSectorEnergyPriceForProductAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                  
        $this->form= new DomoprimeSectorEnergyPriceForProductForm();
        $this->item=new DomoprimeProductSectorEnergy($request->getPostParameter('DomoprimeSectorEnergyProduct'));         
    }

}
