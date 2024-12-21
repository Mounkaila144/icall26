<?php


class SiteServiceServerSelectedForm extends mfForm {
 
    
      function configure()
    {
         $this->setValidators(array(
               "servers"=>new mfValidatorChoice(array("required"=>false,'choices'=>SiteServicesServer::getServersForChoices(),'multiple'=>true)),
         )) ;
    }
}

