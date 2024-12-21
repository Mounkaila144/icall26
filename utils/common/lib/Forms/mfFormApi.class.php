<?php

class mfFormApi extends mfForm {
    
    static function getToken($secret=null)
    {
       return sha1("ewebsolutionskech-".$secret.session_id()); 
    }        


    public function getCSRFToken($secret = null)
  {
    return sha1("ewebsolutionskech-".$secret.session_id());
  }
    
}