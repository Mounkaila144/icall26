<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                           
                           'widgets'=>array('messages'=>null),                                           
                          ),
     
     /*====================================== D A S H B O A R D ============================== */
          /*    'dashboardList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'dashboard|users',
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                ),
                            'widgets'=>array("banner"=>null),
                            'stylesheets'=>array("main.css"=>null),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                             ),  */
     
              'ajaxDashboardList'=>array('functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("date"=>null),   
                            ),
     
              'ajaxDashboardListPartial'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("date"=>null),   
                            ),    
     
              'ajaxDashboardSaveUser'=>array(
                               "template"=>"users_ajaxDashboardViewUser.tpl",                           
                            ),
     
              'ajaxDashboardGroupsList'=>array( 
                            'functions'=>array('html_options_format'=>null)
                            ), 
     
     /* ================================= S I T E ============================================== */
    /*          'list'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'site|users',
                            'stylesheets'=>array("main.css"=>null),
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'widgets'=>array("banner"=>null),
                             ),  
     */
              'ajaxList'=>array('functions'=>array('html_options_format'=>null),   
                    'helpers'=>array("date"=>null),   
                            ),
     
              'ajaxListPartial'=>array(
                            'functions'=>array('html_options_format'=>null), 
                    'helpers'=>array("date"=>null),   
                            ),
     
             'ajaxViewUser'=>array(                                    
                                   'functions'=>array('html_options_format'=>null)
                            ),
             'ajaxNewUser'=>array(                                    
                                   'functions'=>array('html_options_format'=>null)
                            ),
              'ajaxSaveUser'=>array(
                                    "template"=>"users_ajaxViewUser.tpl", 
                                   'functions'=>array('html_options_format'=>null)
                            ),
     
   /*           'accountIdentity'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'dashboard|my account|identity',
                            'stylesheets'=>array("main.css"=>null),
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'widgets'=>array("banner"=>null),
                             ),  
     
              'ajaxAccountIdentitySave'=>array(
                                "template"=>"users_ajaxAccountIdentityView.tpl",
                                'blocks'=>array("JqueryScriptsReady"=>null),
                            ),
     
              'ajaxAccountIdentityView'=>array(
                                'blocks'=>array("JqueryScriptsReady"=>null),
                            ),
       */       
     
              'ajaxGroupsList'=>array( 
                            'functions'=>array('html_options_format'=>null)
                            ), 
    
              'emailPasswordRegenerated'=>array(
                                    'widgets'=>array("banner"=>null),                
                                    "security"=>array(
                                    "php_functions"=>array(
                                                    "format_country"=>'',
                                                   ),
                                   ),
                            ),
     
   /*            "pdfExport"=>array(
                            "widgets"=>array("banner"=>null),
                            "helpers"=>array("date"=>""),
                            "security"=>array("php_functions"=>array(
                                                        "format_date"=>'',
                                                       ),


                                              ),
                        ),
       */ 
     
     "ajaxSaveCreatePasswordUser"=>array(
                    "template"=>"users_ajaxCreatePasswordUser.tpl"
     ),
     
     /* ======================= F U N C T I O N ================================================= */
     
      'ajaxSaveNewFunctionI18n'=>array(
                                    'template'=>"users_ajaxNewFunctionI18n.tpl",                                                                                 
                 ), 
     
     'ajaxSaveFunctionI18n'=>array(
                                    'template'=>"users_ajaxViewFunctionI18n.tpl",                                                                                                                                                       
                                                      
                 ), 
     
     'ajaxSaveUserFunction'=>array(
                                    'template'=>"users_ajaxViewUserFunction.tpl",                                                                                                                                                       
                                                      
                 ), 
     
       /* ======================= A T T R I B U T I O N ================================================= */
     
      'ajaxSaveNewAttributionI18n'=>array(
                                    'template'=>"users_ajaxNewAttributionI18n.tpl",                                                                                 
                 ), 
     
     'ajaxSaveAttributionI18n'=>array(
                                    'template'=>"users_ajaxViewAttributionI18n.tpl",                                                                                                                                                       
                                                      
                 ), 
     
     'ajaxSaveUserAttribution'=>array(
                                    'template'=>"users_ajaxViewUserAttribution.tpl",                                                                                                                                                       
                                                      
                 ), 
     /* ======================= T E A M ================================================= */
     
      'ajaxNewTeam'=>array(
                'functions'=>array('html_options_format'=>null),
      ),
     
       'ajaxViewTeam'=>array(
                'functions'=>array('html_options_format'=>null),
      ),
     
      'ajaxSaveTeam'=>array(
                        'functions'=>array('html_options_format'=>null),
                                    'template'=>"users_ajaxViewTeam.tpl",                                                                                 
                 ), 
     
     "ajaxSaveTeamUsers"=>array(
                                    'template'=>"users_ajaxViewTeamUsers.tpl",                                                                                 
                 ), 
     
     "ajaxSaveDashboardChangeSuperadminPassword"=>array(
         "template"=>"users_ajaxDashboardChangeSuperadminPassword.tpl"
     ),
         
); 
 
