<?php

class customers_contracts_DashboardConfigurationTimeStatusMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
           $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}