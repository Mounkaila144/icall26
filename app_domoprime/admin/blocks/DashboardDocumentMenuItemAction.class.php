<?php

class app_domoprime_DashboardDocumentMenuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
          $this->user=$this->getUser();    
       $this->item=$this->getParameter('item');        
    } 
    
    
}