<?php

class dashboard_tabHomeActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                     
      $this->tabs=TabsManager::getInstance('dashboard.home');  
      $this->user=$this->getUser();    
    } 
    
    
}