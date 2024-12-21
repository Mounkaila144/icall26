<?php
// key = [action][view]
 return array(
                'all'=>array('classView'=>'SmartyView',
                    'widgets'=>array('messages'=>array()),
                          ),
     
      "ajaxSettings"=>array(
             'blocks'=>array("JqueryScriptsReady"=>""),
      ),
     
        'ajaxListSiteServices'=>array(
                  'helpers'=>array("date"=>null,'number'=>null),                   
                  'blocks'=>array("JqueryScriptsReady"=>null),                                            
            "security"=>array(
                   "php_functions"=>array(
                                   "format_size"=>null
                                  ),
                  ),
        ),
        
        "ajaxListPartialSiteServices"=>array(
                    'helpers'=>array("date"=>null,'number'=>null), 
                     'blocks'=>array("JqueryScriptsReady"=>null),   
              "security"=>array(
                   "php_functions"=>array(
                                   "format_size"=>null
                                  ),
                  ),
        ),
     
        "ajaxSaveSiteServicesServer"=>array(
                "template"=>"site_services_ajaxViewSiteServicesServer.tpl",     
        ),
            
     
       'ajaxRefresh'=>array(
                  'helpers'=>array("date"=>null),                   
                  'blocks'=>array("JqueryScriptsReady"=>null),   
                 
                 ),
     
     
      "_tabsDashboardServers"=>array(
            "plugins"=>array('helpers'=>array("date"=>null,'number'=>null), 
            ),         
              "security"=>array(
                   "php_functions"=>array(
                                   "format_size"=>null
                                  ),
                  ),
        ),
     
     "ajaxSaveSite"=>array(
         "template"=>"site_services_ajaxViewSite.tpl"
     ),
     
        "ajaxImportInformation"=>array(
          'helpers'=>array(
                "number"=>null),                                     
                'security'=>array(
                    "php_functions"=>array(
                       "format_size"=>null),),     
         
     ),
); 
 
