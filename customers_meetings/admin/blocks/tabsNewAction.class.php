<?php

class customers_meetings_tabsNewActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                   
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-new')->getTabs(); 
      $this->user=$this->getUser();
      $this->key=$this->getParameter('key');
    } 
    
    
}