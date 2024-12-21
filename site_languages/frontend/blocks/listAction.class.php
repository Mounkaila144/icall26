<?php

class languages_listActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        if ($this->languages)
            return ;
        $this->languages=languageUtils::getLanguages(); //mfConfig::get('mf_languages'); //array('fr','en','de','gr','es');
        $this->language_active=$request->getCountry();    
        $this->referer=$request->getParameter('route_i18n',$request->getParameter('route'));       
        $this->referer=$request->getParameter('route_i18n_full',$request->getParameter('route_full'));     
        $this->uri=$request->getURI();   
        $this->get_parameters=$request->getGetParametersForURL();        
    } 
    
    
}