<?php

class ContactForm extends mfForm {
    
    function configure() {
        $this->setValidators(array(
            'name' => new mfValidatorString(array('required' => false)),
            'email' => new mfValidatorEmail(array(),array("invalid"=>__("invalid email"),"@"=>"@ is missing")),
            'message' => new mfValidatorString(array('min_length' => 4),array("min_length"=>__("\"{value}\" est trop court besoin de {min_length} caractères"))),
        ));
    }
    
}

