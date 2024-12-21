<?php

class app_domoprime_linkForGenerateDocumentsForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        $this->contract=$this->getParameter('contract') ;
        $this->user=$this->getUser(); 
        if (CustomerContractSettings::load()->hasPolluter() && !$this->contract->hasPolluter())
           return mfView::NONE;
    } 
    
    
}