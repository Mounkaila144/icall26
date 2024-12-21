<?php

return array(
        "site.change"=>array(
                    "change"=>array("SiteEvents","siteChange"),
                             ),
    
    //   "site.create"=>array(
     //               "create"=>array("siteEvents","siteCreate"),
    //                        ),
    
       "sites.change"=>array(
                    "change"=>array("SiteEvents","sitesChange"),
                             ),
    
      "site.initialization.execute"=>array(
                    "sitee"=>array("SiteEvents","initializationExecute"),
                             ),
    );