<?php


return array(   
    
    "customers_signin"=>array("pattern"=>"/client/enregistrement","module"=>"customers","action"=>"signin"),
    
    
    "customers"=>array("pattern"=>'/client/admin/{action}',
                            "module"=>"customers",
                            "action"=>"{action}",
                            "requirements"=>array("action"=>".*")),
    
    "customers_account"=>array("pattern"=>'/client/compte',
                            "module"=>"customers",
                            "action"=>"account",
                            ),
    
  
);
