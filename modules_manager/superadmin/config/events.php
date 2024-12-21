<?php

return array(
        "module.installed"=>array(
                    "modules_manager"=>array("moduleManagerEvents","moduleInstall"),
                             ),
        "module.uninstalled"=>array(
                    "modules_manager"=>array("moduleManagerEvents","moduleUninstall"),
                             ),
       "site.create"=>array(
                    "modules_manager"=>array("moduleManagerEvents","siteCreated"),
       ),
   
    );