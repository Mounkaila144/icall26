<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>null),
                          ),
    
             //   'error404'=>array('title'=>"Page not found"),
     
       'signin'=>array(      'template'=>'login.tpl',
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery-1.11.1.min.js'=>null),                                
                           //  'javascripts'=>array('jquery-1.7.min.js'=>null),
                             'title'=>"Login", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),
  
     /* =========================== DASHBOARD ================================================ */
     
 /*      'dashboardPermissionsList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                        ),
                            'title'=>'dashboard|permissions',
                            'stylesheets'=>array(
                                                 'main.css'=>null
                             ),
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                ),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_i18n'=>null),
                            'widgets'=>array("banner"=>null),
                             ),    
   */  
       'ajaxDashboardListPermission'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
       ),
       
       'ajaxDashboardListPartialPermission'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
       ),
     
    /*   'dashboardConnexionsList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                        ),
                            'title'=>'dashboard|connexions',
                            'stylesheets'=>array('themes/base/jquery.ui.all.css'=>null,
                                                 'ui.datepicker.css'=>null,
                                                 'main.css'=>null
                             ),
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                ),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            'widgets'=>array("banner"=>null),
                            'security'=>array(
                                    "php_functions"=>array(
                                                        "format_date"=>null,
                                                   ),
                                   ),
                             ), 
    */ 
       'ajaxDashboardSavePermission'=>array("template"=>"users_guard_ajaxDashboardViewPermission.tpl"
                            ),
     /*
       'dashboardGroupsList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                        ),
                            'title'=>'dashboard|groups',
                            'stylesheets'=>array(
                                                 'main.css'=>null
                             ),
                            'javascripts'=>array(
                                                 'jquery-1.11.1.min.js'=>null,
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                ),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_i18n'=>null),
                            'widgets'=>array("banner"=>null),
                             ),     
    */ 
       'ajaxDashboardListGroups'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_format'=>null),
                             ),  
     
       'ajaxDashboardListPartialGroups'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_format'=>null),
                             ),  
   /*  
       'ajaxDashboardGroupsSaveGroup'=>array("template"=>"userGuard_ajaxDashboardGroupsViewGroup.tpl"
                            ),
     
       'ajaxDashboardConnexionsList'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array(
                                                        "format_date"=>null,
                                                   ),
                                   ),
                             ),                             
     
       'permissionsList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'site|permissions',
                            'stylesheets'=>array(
                                                 'main.css'=>null
                             ),
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                ),
                            'blocks'=>array('JqueryScriptsReady'=>null),
                            'functions'=>array('html_options_i18n'=>null),
                            'widgets'=>array("banner"=>null),
                             ),  */ 
     
     /* =============================== SITE =================================================== */
      'ajaxListPermission'=>array(
                            'blocks'=>array('JqueryScriptsReady'=>null),
                            'functions'=>array('html_options_format'=>null),
                             ),   
     
      'ajaxListPartialPermission'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array('JqueryScriptsReady'=>null),
                             ),    
     
      'ajaxSavePermission'=>array("template"=>"users_guard_ajaxViewPermission.tpl"
                            ),
       
      'ajaxListPartialGroup'=>array(                          
                            'functions'=>array('html_options_format'=>null),
                            'helpers'=>array("date"=>null,'module'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null,'isModuleInstalled'=>null), 
                            ),
       ),  
     
       'ajaxListGroup'=>array(                           
                            'functions'=>array('html_options_format'=>null),
                            'helpers'=>array("date"=>null,'module'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null,'isModuleInstalled'=>null), 
                            ),
                             ),
      'ajaxNewGroup'=>array(
             'helpers'=>array("date"=>null,),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
                            ),
      'ajaxViewGroup'=>array(
             'helpers'=>array("date"=>null,),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
                            ),
        'ajaxSaveGroup'=>array("template"=>"users_guard_ajaxViewGroup.tpl",
             'helpers'=>array("date"=>null,),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
                            ),
    /*  
       'ajaxGroupsSaveGroup'=>array("template"=>"userGuard_ajaxGroupsViewGroup.tpl"
                            ),
     
       'groupsList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'site|groups',
                            'stylesheets'=>array(
                                                 'main.css'=>null
                             ),                
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'widgets'=>array("banner"=>null),
                             ), 
     
      'ajaxConnexionsList'=>array(
                            'stylesheets'=>array('themes/base/jquery.ui.all.css'=>null,
                                                 'ui.datepicker.css'=>null,
                             ),
                            'javascripts'=>array(
                                              //   'ui/jquery.ui.core.min.js'=>null,
                                              //   'ui/jquery.ui.widget.min.js'=>null,
                                              //   'ui/jquery.ui.datepicker.min.js'=>null,
                                       //          'utils.js'=>null,
                                    //             'filter.js'=>null
                                    ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            "widgets"=>array(
                                             "javascripts"=>null,
                                             "stylesheets"=>null
                                            ),
                            'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array(
                                                        "format_date"=>null,
                                                   ),
                                   ),
     ), 
                             
     'ajaxConnexionsListPartial'=>array(
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array(
                                                        "format_date"=>null,
                                                   ),
                                   ),
     ), 
     
     "ajaxDashboardGroupsAddPermissionsSave"=>array(
                            'template'=>"ajaxDasboardGroupsAddPermissions.tpl"
      ),*/
     
       'ajaxSaveNewPermissionGroupI18n'=>array(
                                    'template'=>"users_guard_ajaxNewPermissionGroupI18n.tpl",                                                                                                                                                     
                                                      
                 ), 
     
     'ajaxSavePermissionGroupI18n'=>array(
                                    'template'=>"users_guard_ajaxViewPermissionGroupI18n.tpl",                                                                                                                                                         
                                                      
                 ), 
     
     "ajaxListPermissionsGroup"=>array(
          'helpers'=>array('module'=>null),
                            'security'=>array(
                                    "php_functions"=>array('isModuleInstalled'=>null), 
                            ),
     ),
     
     
     'ajaxListPartialSessionForUser'=>array(                                                     
                        'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
                             ),
     
      /* ============================= Session =========================== */
     
     'ajaxListPartialSession'=>array(
                "helpers"=>array("date"=>""),
                'security'=>array(
                    'php_functions'=>array('format_date'=>''),
                ),   
     ),
     
      'ajaxListSession'=>array(
                "helpers"=>array("date"=>""),
                'security'=>array(
                    'php_functions'=>array('format_date'=>''),
                ),   
     ),
     
     
      'ajaxImportGroup'=>array(                                                                                       
                                     'helpers'=>array(
                                                "number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
     
     
       'ajaxImportPermissionsForGroup'=>array(                                                                                       
                                     'helpers'=>array(
                                                "number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
     
     
     "ajaxSaveReAffectGroup"=>array(
                                    'template'=>"users_guard_ajaxReAffectGroup.tpl",                                                                                                                                                         
                                                      
                 ), 
     
     "ajaxMultipleProcessSelection"=>array(
           "template"=>"users_guard_ajaxMultipleUpdateProcess.tpl"
     ),
     
      "ajaxMultipleAffectationProcessSelection"=>array(
           "template"=>"users_guard_ajaxMultipleAffectationUpdateProcess.tpl"
     ),
     
      'signinByCode'=>array(    
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                  ),                                
                             'title'=>"Login", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),
    'authentificationByCode'=>array( 
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                  ),                                
                             'title'=>"Authentification validation", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),
     
); 
 
