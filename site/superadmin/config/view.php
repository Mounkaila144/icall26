<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>array()),
                          ),
     
                'ajaxHome'=>array(
                                'settings'=>array("sublink_separator"=>"|"),                                
                          ),
     
                'ajaxNewSite'=>array(
                                    'functions'=>array('html_options_format'=>null),
                                ),
     
                'ajaxViewAdminSite'=>array(
                                    'functions'=>array('html_options_format'=>null),
                                ),
     
                'ajaxSaveAdminSite'=>array(
                                    'template'=>'site_ajaxViewAdminSite.tpl',
                                    'functions'=>array('html_options_format'=>null),
                                ),
     
             /*   'site'=>array(
                                       'layout'=>array(
                                            "template"=>"layout_site.xml",
                                           // "is_secure"=>true,
                                        ),
                                       'stylesheets'=>array("main.css"=>null,
                                                            "themes/base/jquery.ui.all.css"=>null
                                                           ),
                                       'javascripts'=>array(
                                                         'jquery-1.11.1.min.js'=>null,
                                                         'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                         'jquery.custom.js'=>null,
                                                         'jquery.custom.messages.js'=>array("type"=>"url"),
                                                           ),
                                       'title'=>'site administration', 
                                       'widgets'=>array("banner"=>null),
                                   ),*/
     
                'ajaxAdmin'=>array(
                            "widgets"=>array(
                                            "stylesheets"=>null
                                           ),
                           'stylesheets'=>array(
                                     'smoothness/jquery-ui-1.8.16.custom.css'=>array("module"=>'')
                                         
                                           ),                           
                ),
     
     
                "ajaxNewHost"=>array(
                    'functions'=>array('html_options_format'=>null),
                ),
     
                'ajaxCache'=>array(
                    'blocks'=>array("JqueryScriptsReady"=>null),                   
                  ),
     
                'ajaxListLog'=>array(                                
                    'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_size"=>'',"format_date"=>null,
                                                   ),
                                   ),
                  ),
     
                 'ajaxListPartialLog'=>array(
                                
                     'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_size"=>'',"format_date"=>null,
                                                   ),
                                   ),
                  ),
    
     /* =========================================================================== */
     
         'ajaxListPartial'=>array(
                                     'functions'=>array('html_options_format'=>null),
                                     'helpers'=>array("date"=>null),                            
                                     'blocks'=>array('JqueryScriptsReady'=>null),
              'helpers'=>array('number'=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_size"=>'',
                                                   ),
                                   ),
                                  ),
     /* ======================= B L O C K S ======================================== */
     
        '_sitesList'=>array(
                    "plugins"=>array(                
                                    // 'functions'=>array('html_options_format'=>null),
                                     'helpers'=>array("date"=>null,'number'=>null),
                                     'blocks'=>array('JqueryScriptsReady'=>null)
                                  ),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_size"=>'',
                                                   ),
                                   ),
        ),
     
        '_tabDashboardSite'=>array(
                    "plugins"=>array(                
                                   //  'functions'=>array('html_options_format'=>null),
                                   //  'blocks'=>array('JqueryScriptsReady'=>null)
                                  )
        ),
     
     
      '_tabsDashboardSite'=>array(                             
                            "plugins"=>array(                                                   
                                     'blocks'=>array('JqueryScriptsReady'=>null)
                                  )
                             ),
     
          "ajaxDialogListFilterMultipleSites"=>array(         
                    'blocks'=>array('JqueryScriptsReady'=>null),
               ),
     
 
     
     "ajaxSaveCompanySite"=>array(
            "template"=>"site_ajaxCompanySite.tpl"
     ),
     
      "ajaxImportCompany"=>array(
          'helpers'=>array(
                "number"=>null),                                     
                'security'=>array(
                    "php_functions"=>array(
                       "format_size"=>null),),     
         
     ),
); 
 
