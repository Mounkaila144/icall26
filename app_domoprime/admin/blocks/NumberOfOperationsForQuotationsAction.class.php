<?php

class app_domoprime_NumberOfOperationsForQuotationsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_quotations_number_of_operations'))))
               return mfView::NONE;                   
          $this->number_of_operations=DomoprimeQuotation::getNumberOfOperationsQuotationsFromFilter($this->getParameter('filter'));        
    } 
    
    
}