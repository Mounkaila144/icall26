<?php

class site_menuDashboardActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
     
      /*  if ($this->getUser()->hasCredential(array(array('site_dashboard_system_menu'))))
        { 
          $this->menu= SystemMenu::load('site.dashboard')->getMenu(); 
        }
        else 
        {
           $this->menu= MenuManager::getInstance('site.dashboard')->getMenu();
        }*/
         
        $this->user=$this->context->getUser();   
   $this->menu= MenuManager::getInstance('site.dashboard')->getMenu();
    // $this->menu= SystemMenu::load('site.dashboard')->getMenu(); 
      /*foreach($this->menu  as $menu)
      {
      //  echo "<pre>"; var_dump($menu->get("name")); echo "</pre>";
        echo "<li>"; echo $menu->get("component").'---------'.$menu->get("name");
         echo "<pre>"; var_dump($menu->getRouteAjax()); echo "</pre>";
         echo "</li>";
        // $this->getComponent($menu->get("component"));
            
            if($menu->hasChildren())
           {   echo "<ul>";
              foreach($menu->getChildren() as $child)
            {
           //   echo "<pre>-1-"; var_dump($child->get('title')); echo "</pre>";
               echo "<li>"; echo $child->get("component").'--------'.$menu->get("name");
                echo "<pre>"; var_dump($child->getRouteAjax()); echo "</pre>";
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
       die(__METHOD__); */
   
    } 
    
    
}