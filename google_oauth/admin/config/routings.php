<?php


return array(
  "google_oauth_callback_user"=>array("pattern"=>'/google/oauth/callback/user',
                            "module"=>"google_oauth",
                            "action"=>"callbackUser",
                            ),
    "google_oauth_ajax" => array("pattern" => '/module/google/oauth/admin/{action}', 
                               "module" => "google_oauth", 
                               "action" => "ajax{action}", 
                               "requirements" => array("action" => ".*")),
    
    
      "google_oauth" => array("pattern" => '/google/oauth/admin/{action}', 
                               "module" => "google_oauth", 
                               "action" => "{action}", 
                               "requirements" => array("action" => ".*")),

);
