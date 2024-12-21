<?php

return array(
        "user.signin"=>array(
                    "email.sent"=>array("UserEvents","listenUserSignin"),
                             ),
        "user.change"=>array(
                    "user.change"=>array("UserEvents","userChange"),
                             ),
         "users.change"=>array(
                    "users.change"=>array("UserEvents","usersChange"),
                             ),
    
        "site.initialization.form.config"=>array(
                "users.initialization.form.config"=>array("UserEvents","initializationFormConfig"),
        ),
    
         "site.initialization.execute"=>array(
                "users.initialization.execute"=>array("UserEvents","initializationExecute"),
        ),
    
        "user.connected"=>array(
             "users"=>array("UserEvents","userConnected"),
        )
        
    );