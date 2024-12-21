<?php

class app_domoprime_StatisticsForContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_statistics'))))
               return mfView::NONE;                   
          $this->rows=DomoprimeCalculation::getStatisticsFromFilter($this->getParameter('filter'));        
    } 
    
    
}