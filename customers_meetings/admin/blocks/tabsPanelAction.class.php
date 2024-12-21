<?php

class customers_meetings_tabsPanelActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                   
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-view')->getComponents(); 
      $this->key=$this->getParameter('key');    
      $this->user=$this->getUser();
     // $this->form=$this->getParameter('form');  
     // $this->meeting=$this->getParameter('meeting');  
    } 
    
    
}