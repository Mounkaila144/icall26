<?php

return array(
   
    
        "site.create"=>array(
               "server_services"=>array("ServerServiceEvents","setCreateSite"),
        ),
    
        "host.create"=>array(
               "server_services"=>array("ServerServiceEvents","setCreateHost"),
        ),
      
        'site.export.installed'=>array(
               "server_services"=>array("ServerServiceEvents","setExportSite"),
        ),
    
       
    );