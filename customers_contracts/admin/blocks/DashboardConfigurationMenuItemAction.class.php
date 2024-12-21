<?php

class customers_contracts_DashboardConfigurationMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
              $this->user=$this->getUser();  
              $this->item=$this->getParameter('item');        
    } 
    
    
}