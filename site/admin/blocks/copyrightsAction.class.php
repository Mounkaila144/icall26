<?php

 
class site_copyrightsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {
        if (!$this->getParameter('enable',true))
             return mfView::NONE;      
        $this->year=date("Y");
    }
    
}    