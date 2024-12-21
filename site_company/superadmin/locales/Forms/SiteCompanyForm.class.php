<?php


class SiteCompanyForm extends SiteCompanyBaseForm {
    
     function configure() {
         parent::configure();
         unset($this['id']);
     }
    
}


