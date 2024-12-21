<?php


class customers_contracts_TreatmentAttributionsProcessActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {          
        $this->number_of_contracts=CustomerContractContributor::getNumberOfContractsToComplete();
    } 
    
    
}