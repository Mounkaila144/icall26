<?php

class site_menu_adminActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {               
       $this->menu= MenuManager::getInstance('site_admin')->getMenu();
       $this->user=$this->context->getUser();
    } 
    
    
}