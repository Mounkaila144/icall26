<?php

class app_domoprime_NumberOfCumacForContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_number_of_cumac'))))
               return mfView::NONE;                   
          $this->results=DomoprimeCalculation::getNumberOfCumacFromFilter($this->getParameter('filter'));        
    } 
    
    
}