<?php

class utils_mysqlTracerActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                   
        $text=$this->getParameter('text','MySQL');  
        trigger_error($text.":".mfSiteDatabase::getCountQuery()."\n");
        return mfView::NONE;
    } 
    
    
}