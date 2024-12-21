<?php

class customers_meetings_DashboardMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->user=$this->getUser();
       $this->item=$this->getParameter('item');               
    } 
    
    
}