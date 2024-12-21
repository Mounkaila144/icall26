<?php

class system_debug_LinkActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        if (!$this->getUser()->hasCredential(array(array('superadmin','superadmin_debug_display'))))
                return mfView::NONE;
        $this->user=$this->getUser();
    } 
    
    
}