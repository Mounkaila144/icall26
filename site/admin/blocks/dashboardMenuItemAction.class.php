<?php

class site_dashboardMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}