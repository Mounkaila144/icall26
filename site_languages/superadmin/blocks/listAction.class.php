<?php

class languages_listActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        $this->languages=languageUtils::getLanguages(); //mfConfig::get('mf_languages'); //array('fr','en','de','gr','es');
       // $this->language_active=$request->getCulture();
        $this->language_active=$request->getCountry();
        $this->referer=$request->getURI();
    } 
    
    
}