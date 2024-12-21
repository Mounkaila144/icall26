<?php


class  DomoprimeSubventionTypeNewForm extends  DomoprimeSubventionTypeBaseForm {
         
    
      function configure() {
          parent::configure();
          unset($this['id']);
      }
     
}

