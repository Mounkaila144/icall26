<?php

class TaxNewForm extends TaxBaseForm {

  
    function configure() 
    { 
      parent::configure();
      unset($this['id']);       
    } 
}