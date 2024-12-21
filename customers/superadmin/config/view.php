<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
       'ajaxListPartial'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                       ),
     /*          'index'=>array(
                              "layout"=>array(
                                        "template"=>"layout_dashboard.xml",                                      
                                        ),
                              'title'=>'dashboard',
                              'blocks'=>array('JqueryScriptsReady'=>null),
                              'functions'=>array('html_options_format'=>null), // Mandatory
                              'stylesheets'=>array("main.css"=>null,"ui/jquery-ui.min.css"=>null),
                              'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                   'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),
                                                   'ui/jquery-ui.min.js'=>null,
                                                  ),
                             ),
               'ajaxIndex'=>array(
                     'blocks'=>array('JqueryScriptsReady'=>null),
               ),*/
    /*           'logsList'=>array(
                             "layout"=>array(
                                        "template"=>"layout_dashboard.xml",                                      
                                        ),
                             'title'=>'Dashboard / Logs',
                             'stylesheets'=>array("main.css"=>null,
                                                 'themes/base/jquery.ui.all.css'=>null,
                                                 'ui.datepicker.css'=>null,
                                                 ),
                             'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                  'jquery.custom.js'=>null,
                                                  'jquery.custom.messages.js'=>array("type"=>"url"),
                                                  'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 ),
                             'blocks'=>array('JqueryScriptsReady'=>null),
                             'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_size"=>'',"format_date"=>null,
                                                   ),
                                   ),
                            ),
               'ajaxLogList'=>array(
                             'blocks'=>array('JqueryScriptsReady'=>null),
                             'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_size"=>'',"format_date"=>null,
                                                   ),
                                   ),
                            ),
               'error404'=>array('title'=>"Page not found",
                            ),
     
               'preferencesView'=>array(
                              "layout"=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                              'title'=>'Dashboard / Preferences',
                              'stylesheets'=>array("main.css"=>null),
                              'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                   'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),
                                                   'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                  ),
                              'blocks'=>array('JqueryScriptsReady'=>null),
                             ),   
     
                'cache'=>array(
                              "layout"=>array(
                                        "template"=>"layout_dashboard.xml",                                     
                                        ),
                              'title'=>'dashboard | cache',
                              'stylesheets'=>array("main.css"=>null),
                              'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                   'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),
                                                   'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                  ),
                              'blocks'=>array('JqueryScriptsReady'=>null),
                             ), */
     
     /*  'ajaxCache'=>array(                             
                              'blocks'=>array('JqueryScriptsReady'=>null),
                             ),*/
     
     /* ========================== UNION ======================================================== */
     
     
      'ajaxSaveNewUnionI18n'=>array(
                                    'template'=>"customers_ajaxNewUnionI18n.tpl",                                                                                 
                                    
      ), 
     
     'ajaxSaveUnionI18n'=>array(
                                    'template'=>"customers_ajaxViewUnionI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     "ajaxSaveCustomerForContract"=>array(
                    "template"=>"customers_ajaxModifyCustomerForContract.tpl"
     ),
 ); 
 
