<?php

class site_text_loadTextsActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
       SiteText::loadByModule($this->getParameter('module')); 
     //  $tmp=__('');
       return mfView::NONE;
    } 
    
    
}