<?php

class dashboard_tabsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {             
        
     //   $this->tabs=TabsManager::getInstance('dashboard.site'); 
       // $this->tabs=new SystemTab();
     //   $this->tabs->loadTabs('dashboard.site'); 
        
       $this->tabs=SystemTab::load('dashboard.site');
             
      //   echo '<pre>';var_dump($this->tabs->getSortedTabs());echo '<pre>';
         
      //   die(__METHOD__);
        //echo '---------';
       // echo '<pre>';var_dump(SystemTab::loadTabs('dashboard.site'));echo '<pre>';
//        foreach (TabsManager::getInstance('dashboard.site')->getTabs() as $tab){
//            echo '<pre> ++++';var_dump($tab['name']);echo ' ++++<pre>';
//        }
        $this->user=$this->getUser();
    } 
    
    
}