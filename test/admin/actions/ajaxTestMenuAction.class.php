<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomersFormFilter.class.php";

// www.projet3.net/admin/module/site/test/admin/Test
class test_ajaxTestMenuAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {        
    //    DomoprimeQuotationUtils::transferSignedAtToSavAtContract();
       // $this->menus= SystemMenu::load('site.dashboard')->getMenus();
        $menu= SystemMenu::load('site.dashboard')->getMenu(); 
         echo "<pre>";var_dump($menu);echo "</pre>";
//          echo "<ul>";
//     foreach($this->menu  as $menu)
//      {
//      //  echo "<pre>"; var_dump($menu->get("name")); echo "</pre>";
//        echo "<li>"; echo $menu->get("name");echo "</li>";
//        // $this->getComponent($menu->get("component"));
//            
//            if($menu->hasChildren())
//           {   echo "<ul>";
//              foreach($menu->getChildren() as $child)
//            {
//           //   echo "<pre>-1-"; var_dump($child->get('title')); echo "</pre>";
//               echo "<li>"; echo $child->get('name');echo "</li>";
//                
//                 if($child->hasChildren())
//                {   
//                          echo "<ul>";
//                       foreach($child->getChildren() as $child1)
//                        {
//                       
//                        echo "<li>---";echo $child1->get('name');echo "</li>";
//
//                        }
//                          echo "</ul>";
//                }
//            }
//              echo "</ul>";
//          }
//            
//       } 
//    
        die(__METHOD__);      
        $messages = mfMessages::getInstance(); 
        
    } 
}

