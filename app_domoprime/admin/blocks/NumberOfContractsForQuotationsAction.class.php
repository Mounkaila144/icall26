<?php

class app_domoprime_NumberOfContractsForQuotationsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_quotations_number_of_contracts'))))
               return mfView::NONE;                   
          $this->number_of_contracts=DomoprimeQuotation::getNumberOfContractsQuotationsFromFilter($this->getParameter('filter'));       
    } 
    
    
}