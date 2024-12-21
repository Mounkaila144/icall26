<?php

class customers_meetings_DashboardConfigurationSettingsMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
          $this->user=$this->getUser();  
           $this->item=$this->getParameter('item');        
    } 
    
    
}