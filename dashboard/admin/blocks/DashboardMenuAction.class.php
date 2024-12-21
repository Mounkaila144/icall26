<?php

class dashboard_DashboardMenuActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
      
      $this->menu= MenuManager::getInstance('Dashboard')->getMenu();        
     // $this->menu= SystemMenu::load('Dashboard')->getMenu(); 
     //var_dump($this->menu);die();
       //SystemDebug::getInstance()->dumpMenu($this->menu);   
       $this->user=$this->getUser();
       $this->url_selected=$request->getURI();         
  
     /*  echo "<ul>";
      foreach($this->menu  as $menu)
      {
         //echo "<pre>"; var_dump($menu->get("name")); echo "</pre>";
        echo "<li>++"; echo $menu->get("component").'++<br>';//.$menu->get("name");
      //   echo "<pre>"; var_dump($menu->getRouteAjax()); echo "</pre>";
         echo "</li>";
        // $this->getComponent($menu->get("component"));
            
            if($menu->hasChildren())
           {   echo "<ul>";
              foreach($menu->getChildren() as $child)
            {
           //   echo "<pre>-1-"; var_dump($child->get('title')); echo "</pre>";
               echo "<li>++"; echo $child->get("component").'++<br>';//.$menu->get("name");
               // echo "<pre>"; var_dump($child->getRouteAjax()); echo "</pre>";
                echo "</li>";
                 if($child->hasChildren())
                {   
                          echo "<ul>";
                       foreach($child->getChildren() as $child1)
                        {
                       
                         echo "<li>";echo $child1->get('title');echo "******".$child1->get('name');echo "</li>";

                        }
                          echo "</ul>";
                }
            }
              echo "</ul>";
          }
            
       } 
      die(__METHOD__);   
        */
    } 
   
}