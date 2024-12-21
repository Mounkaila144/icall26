<?php

class app_domoprime_iso_DashboardCustomerRequestMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->user=$this->getUser();
        $this->item=$this->getParameter('item');        
    } 
    
    
}