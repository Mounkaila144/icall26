<?php

class dashboard_DashboardMenu2ActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->menu= MenuManager::getInstance('Dashboard2')->getMenu();        
       SystemDebug::getInstance()->dumpMenu($this->menu);
      // echo "<pre>"; var_dump($this->menu); die(__METHOD__);
       $this->user=$this->getUser();
       $this->url_selected=$request->getURI();       
    } 
    
}