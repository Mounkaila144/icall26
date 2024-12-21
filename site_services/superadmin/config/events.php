<?php

return array(
   
    
        "site.create"=>array(
               "site_services"=>array("SiteServiceEvents","setCreateSite"),
        ),
    
        "host.create"=>array(
               "site_services"=>array("SiteServiceEvents","setCreateHost"),
        ),
      
        'site.export.installed'=>array(
              "site_services"=>array("SiteServiceEvents","setExportSite"),
        ),
    
       
    );