<?php

class app_domoprime_NumberOfSurfacesForContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_number_of_surfaces'))))
               return mfView::NONE;                   
          $this->number_of_surfaces=DomoprimeCalculation::getNumberOfSurfacesFromFilter($this->getParameter('filter')); 
          
       // var_dump($this->number_of_surfaces);
    } 
    
    
}