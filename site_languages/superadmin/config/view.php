<?php
// key = [action][view]
 return array('all'=>array( 'classView'=>'SmartyView',                           
                            'widgets'=>array('messages'=>null),  
                          ),    
     
              'dashboardList'=>array(
                             'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                            'stylesheets'=>array("main.css"=>null),
                            'widgets'=>array("banner"=>null),
                            'title'=>'dashboard | languages',
                            'javascripts'=>array('jquery-1.7.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                             ), 
     
              'ajaxDashboardList'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_i18n'=>null),
                            ),
     
              'ajaxDashboardListPartial'=>array(
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_i18n'=>null),
                            ),
     
              'list'=>array(
                            'layout'=>array(
                                        "template"=>"layout_site.xml",
                                       // "is_secure"=>true,
                                        ),
                            'title'=>'site | languages',
                            'stylesheets'=>array("main.css"=>null),
                            'javascripts'=>array('jquery-1.7.min.js'=>null,
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                ),
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                             ),  
     
              'ajaxList'=>array(
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            ),
     
              'ajaxListPartial'=>array(
                            'functions'=>array('html_options_i18n'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            ),
     
               "_listLanguagesFrontend"=>array(
                    "plugins"=>array(
                    ),
                ),
); 
 
