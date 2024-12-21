<?php

class app_domoprime_NumberOfOperationsForContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_number_of_operations'))))
               return mfView::NONE;                   
          $this->number_of_operations=DomoprimeCalculation::getNumberOfOperationsFromFilter($this->getParameter('filter'));        
    } 
    
    
}