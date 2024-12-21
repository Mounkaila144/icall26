<?php

class customers_meetings_tabsPanelNewActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                       
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-new')->getComponents(); 
      $this->user=$this->getUser();
      $this->key=$this->getParameter('key');    
    } 
    
    
}