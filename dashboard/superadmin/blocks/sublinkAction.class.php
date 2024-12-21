<?php

class dashboard_sublinkActionComponent extends mfActionComponent {

          
    function execute(mfWebRequest $request)
    {          
        $this->sublinks=MenuManager::getInstance('dashboard_home')->getMenu()->getSublinks($request->getParameter('route_full'),$request->isXmlHttpRequest());       
    } 
    
    
    
}