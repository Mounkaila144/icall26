<?php


class SiteServiceSiteSelectedForm extends mfForm {
 
    
      function configure()
    {
         $this->setValidators(array(
               "sites"=>new mfValidatorChoice(array("required"=>false,'choices'=>SiteServicesSite::getSitesForChoices(),'multiple'=>true)),
         )) ;
    }
}

