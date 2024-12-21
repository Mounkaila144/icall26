<?php


class CustomerContractCompanyNewForm extends CustomerContractCompanyBaseForm {
    
     function configure() {
         parent::configure();
         unset($this['id']);
     }
    
}


