<?php

require_once __DIR__."/UserForm.class.php";

class UserApiForm extends UserForm {

   
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
    
 /*   static function getToken($secret=null)
    {
       return sha1("ewebsolutionskech-".$secret.session_id()); 
    } */       


   
}