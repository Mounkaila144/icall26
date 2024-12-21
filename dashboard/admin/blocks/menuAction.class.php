<?php

class dashboard_menuActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->menu= menuManager::getInstance('dashboard')->getMenu();          
       $this->user=$this->getUser();
       $this->url_selected=$request->getURI();       
    } 
    
    
}