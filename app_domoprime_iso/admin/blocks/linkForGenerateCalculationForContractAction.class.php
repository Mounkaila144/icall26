<?php

class app_domoprime_iso_linkForGenerateCalculationForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        $this->contract=$this->getParameter('contract') ;
        $this->user=$this->getUser(); 
        
    } 
    
    
}