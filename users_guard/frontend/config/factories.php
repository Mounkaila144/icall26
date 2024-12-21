<?php
// Classes des sites
return array("default"=>array(                             
                                "user"=>array("class"=>"UserGuardSecurity",
                                              "params"=>array("timeout"=>3600,'auto_shutdown'=>false),
                                             ),    
    
                                 "mailer"=>array("params"=>array(
                                                    "templating"=>array(
                                                            "class"=>"SmartyView",
                                                            "options"=>array("compile_check"=>true)
                                                             )
                                                        )
                                          )                  
                          )
);

