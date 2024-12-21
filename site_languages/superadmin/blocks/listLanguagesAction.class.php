<?php

class languages_listLanguagesActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request)
    {        
      // @TODO tableau devrait venir d'un settings (file or db ) ?
    //  $countries_allowed=array("at","be","ch","de","dk","ee","en","es","fi","fr","hr","hu","ie","it","li","lt","lu","mt",
     //                "nl","no","pl","pt","ro","se","si");
      
      $countries = mfCultureInfo::getInstance($this->getUser()->getCulture())->getCountries();
      $this->countries=array();
      // @TODO replace by 
      foreach ( languageUtilsAdmin::getLanguagesAllowed() as $code)
          $this->countries[$code]=$countries[strtoupper($code)];
      asort($this->countries,SORT_STRING);
      $this->languages=$this->getParameter('languages'); 
    } 
    
    
}


