<?php

class app_domoprime_NumberOfSurfacesForQuotationsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                         
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_quotations_number_of_surfaces'))))
               return mfView::NONE;                   
          $this->number_of_surfaces=DomoprimeQuotation::getNumberOfSurfacesQuotationsFromFilter($this->getParameter('filter'));       
    } 
    
    
}