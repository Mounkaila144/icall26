<?php

 
class utils_copyrightsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {
        if (!$this->getParameter('enable',true))
             return mfView::NONE;      
    }
    
}    