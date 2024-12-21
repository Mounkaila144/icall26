<?php

class dashboard_menuActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                
       $this->menu= MenuManager::getInstance('dashboard_home')->getMenu();    
       $this->user=$this->getUser();
       $this->url_selected=$request->getURI();                
     //  var_dump($this->menu);
    } 
    
    
}