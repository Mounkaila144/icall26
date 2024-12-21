<?php


return array(   
    
    "customers_signin"=>array("pattern"=>"/client/enregistrement","module"=>"customers","action"=>"signin"),
    
    "customers_forgot_password"=>array("pattern"=>"/client/compte/mot-de-passe-oublie","module"=>"customers","action"=>"forgotPassword"),
    
    "customers_forgot_password_confirm"=>array("pattern"=>"/client/compte/mot-de-passe-oublie/confirmation","module"=>"customers","action"=>"forgotPasswordConfirm"),
        
    "customers_account"=>array("pattern"=>'/client/compte',
                            "module"=>"customers",
                            "action"=>"account",
                            ),
    
    "customers"=>array("pattern"=>'/client/admin/{action}',
                            "module"=>"customers",
                            "action"=>"{action}",
                            "requirements"=>array("action"=>".*")),
    
   
    
  
);
