<?php


class CustomerMeetingCompanyNewForm extends CustomerContractCompanyBaseForm {
    
     function configure() {
         parent::configure();
         unset($this['id']);
     }
    
}


