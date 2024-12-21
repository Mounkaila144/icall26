<?php

class site_languages_listActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {               
        $this->languages=languageUtils::getLanguages('admin');         
        $this->language_active=$request->getCountry();
        $this->referer=$request->getURI();
    } 
    
    
}