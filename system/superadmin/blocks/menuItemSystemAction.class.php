<?php


class system_menuItemSystemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
            $this->user=$this->getUser();
       $this->item=$this->getParameter('item');        
    } 
    
    
}

