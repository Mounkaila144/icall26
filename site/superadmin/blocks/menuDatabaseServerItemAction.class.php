<?php


class site_menuDatabaseServerItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
         $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
          
    } 
    
    
}

