<?php


class site_languages_menuItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
           $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}
