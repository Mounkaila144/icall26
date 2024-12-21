<?php

class customers_contracts_DashboardConfigurationOpcStatusMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
          $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}