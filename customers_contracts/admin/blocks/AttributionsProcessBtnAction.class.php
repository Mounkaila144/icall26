<?php

class customers_contracts_AttributionsProcessBtnActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
         if (!$this->getUser()->hasCredential([['superadmin','settings_user_attribution_process']]))
              return mfView::NONE;   
         $this->user=$this->getUser();
         $this->number_of_contracts=CustomerContractUtils::getNumberOfAttributedContracts();
         $this->number_of_attributions=$this->number_of_contracts - CustomerContractUtils::getNumberOfTeamAttributions(); 
    } 
    
    
}
