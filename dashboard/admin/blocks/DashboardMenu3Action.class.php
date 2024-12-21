<?php

class dashboard_DashboardMenu3ActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->menu= MenuManager::getInstance('Dashboard3')->getMenu();        
       SystemDebug::getInstance()->dumpMenu($this->menu);
     //  echo "<pre>================"; var_dump($this->menu->getChildren()); die(__METHOD__);
       $this->user=$this->getUser();
       $this->url_selected=$request->getURI();       
    } 
    
}