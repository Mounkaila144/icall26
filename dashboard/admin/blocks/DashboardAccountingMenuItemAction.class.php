<?php

class dashboard_DashboardAccountingMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        $this->user=$this->getUser();  
         $this->item=$this->getParameter('item');    
    } 
    
    
}