<?php

class app_domoprime_StatisticsByPollutersForContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_polluter_statistics'))))
               return mfView::NONE;                   
          $this->polluters=DomoprimeCalculation::getStatisticsByPollutersFromFilter($this->getParameter('filter'));        
    } 
    
    
}