<?php

class system_debug_DisplayActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        if (!$this->getUser()->hasCredential(array(array('superadmin_debug','superadmin_debug_display'))))
                return mfView::NONE;
        $this->messages=SystemDebug::getInstance()->getMessages();   
        $this->microtime=mfTools::generateUniqueId();
    } 
    
    
}