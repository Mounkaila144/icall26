<?php

class dashboard_DashboardSchedulesMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
             $this->user=$this->getUser();  
              $this->item=$this->getParameter('item');    
    } 
    
    
}