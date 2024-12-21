<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                          'widgets'=>array('messages'=>null),
                          ),
    
      'list'=>array(        'widgets'=>array("banner"=>null),
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'cron',
                            'stylesheets'=>array("main.css"=>null,
                                                 "themes/base/jquery.ui.all.css"=>null,
                                                ),
                            'javascripts'=>array(   'jquery-1.7.min.js'=>null,
                                                    'jquery.custom.js'=>null,
                                                    'jquery.custom.messages.js'=>array("type"=>"url"),
                                                    'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,
                                                   ),
                                   ),
                             ),  
     'execute'=>array(        'widgets'=>array("banner"=>null),
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'cron execution',
                            'stylesheets'=>array("main.css"=>null,
                                                 "themes/base/jquery.ui.all.css"=>null,
                                                ),
                            'javascripts'=>array(   'jquery-1.7.min.js'=>null,
                                                    'jquery.custom.js'=>null,
                                                    'jquery.custom.messages.js'=>array("type"=>"url"),
                                                    'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                ),
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,
                                                   ),
                                   ),
                             ),  
      'ajaxList'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,
                                                   ),
                                   ),
                            
                       ),
     
      'ajaxListPartial'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'helpers'=>array("date"=>null),
                            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,
                                                   ),
                                   ),
                            
                       ),
     'ajaxReportView'=>array(
                             'helpers'=>array("date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,
                                                   ),
                                   ),
     ),
); 
 
