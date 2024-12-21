<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomersFormFilter.class.php";

// www.projet3.net/admin/module/site/test/admin/Test
class test_ajaxViewMenuAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {        
       //  $menu= menuManager::getInstance('site.dashboard')->getMenu(); 

            $menu=SystemMenu::load('site.dashboard');
            echo "<pre>";  var_dump($menu->getMenus()); echo "</pre>";
            die(__METHOD__);      
            $messages = mfMessages::getInstance(); 
        
    } 
}

