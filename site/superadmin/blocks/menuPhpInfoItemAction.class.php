<?php


class site_menuPhpInfoItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
           $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}

