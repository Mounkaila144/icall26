<?php

return array(   
    "customers_signin"=>array("pattern"=>"/customer/signin","module"=>"customers","action"=>"signin"),
    
    "customers_forgot_password"=>array("pattern"=>"/customer/account/forgotPassword","module"=>"customers","action"=>"forgotPassword"),
    
    "customers_forgot_password_confirm"=>array("pattern"=>"/customer/account/forgotPassword/Confirm","module"=>"customers","action"=>"forgotPasswordConfirm"),
    
    "customers_account"=>array("pattern"=>'/customer/account',
                            "module"=>"customers",
                            "action"=>"account",
                            ),
    
     "customers_account_created"=>array("pattern"=>'/customer/account/created',
                            "module"=>"customers",
                            "action"=>"accountCreated",
                            ),
    
    "customers_subscription_address"=>array("pattern"=>'/customer/subscription/address',
                            "module"=>"customers",
                            "action"=>"address",
                            ),
    
    "customers_logout"=>array("pattern"=>'/customer/logout',
                            "module"=>"customers",
                            "action"=>"logout",
                            ),
    
     "customers_login"=>array("pattern"=>'/customer/login',
                            "module"=>"customers",
                            "action"=>"login",
                            ),
    
  /*   "customers_forgot"=>array("pattern"=>'/customer/logout',
                            "module"=>"customers",
                            "action"=>"logout",
                            ),*/
    
    "customers"=>array("pattern"=>'/customer/admin/{action}',
                            "module"=>"customers",
                            "action"=>"{action}",
                            "requirements"=>array("action"=>".*")),
    
    "customers_ajax"=>array("pattern"=>'/module/customer/admin/{action}',
                            "module"=>"customers",
                            "action"=>"ajax{action}",
                            "requirements"=>array("action"=>".*")),
    
    "customers_restrictive_access_avatar"=>array(
                                    "pattern"=>'/restrictive/data/customers/files/{file}',
                                    "requirements"=>array(
                                                          "file"=>".*",                                                          
                                                         ),
                                    "module"=>"customers",                                   
                                    "action"=>"restrictiveAccessAvatar",
                                    "parameters"=>array("file"=>"{file}")
                                ),
    
     "customers_mobile"=>array("pattern"=>'/mobile/customers/admin/{action}',"module"=>"customers","action"=>"{action}ForMobile","requirements"=>array("action"=>".*")),
);
