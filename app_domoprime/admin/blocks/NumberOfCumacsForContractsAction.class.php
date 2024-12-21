<?php

class app_domoprime_NumberOfCumacsForContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_number_of_cumacs'))))
               return mfView::NONE;                   
          $this->number_of_cumacs=DomoprimeCalculation::getNumberOfCumacsFromFilter($this->getParameter('filter')); 
          
       // var_dump($this->number_of_surfaces);
    } 
    
    
}