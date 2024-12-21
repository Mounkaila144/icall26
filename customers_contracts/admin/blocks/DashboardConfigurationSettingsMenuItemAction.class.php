<?php

class customers_contracts_DashboardConfigurationSettingsMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
          $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}