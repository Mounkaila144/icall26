<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>null,"banner"=>null),                             
                          ),
     
                'Admin'=>array(
                                       'layout'=>array(
                                              "template"=>"layout_site.xml",
                                            //  "template"=>"layout_site.xml",
                                              // "is_secure"=>true,
                                        ),
                                       'stylesheets'=>array("main.css"=>null,
                                                            "themes/base/jquery.ui.all.css"=>null
                                                           ),
                                       'javascripts'=>array('jquery-1.11.1.min.js'=>null,                                                          
                                                            'jquery.custom.js'=>null,
                                                            'jquery.custom.messages.js'=>array("type"=>"url"),
                                                            'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                           ),
                                       'title'=>'sites administration', 
                                       'blocks'=>array('JqueryScriptsReady'=>null)
                                   ),
     
                'List'=>array(
                                  'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                                  'stylesheets'=>array("main.css"=>null,
                                                       "themes/base/jquery.ui.all.css"=>null
                                                ),
                                  'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                       'jquery.custom.js'=>null,
                                                       'jquery.custom.messages.js'=>array("type"=>"url"),
                                                       'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                      ), 
                                  'title'=>"Sites List", 
                                  'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),                              
                                  'widgets'=>array('messages'=>null,"banner"=>null),                         
                                  'functions'=>array('html_options_i18n'=>null,"format_size"=>null),
                                  'blocks'=>array('JqueryScriptsReady'=>null),
                                   'helpers'=>array(
                                                "number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
                                  ),     
     
                 'ajaxList'=>array(
                                     'functions'=>array('html_options_i18n'=>null,
                                         "format_size"=>null),
                                     'blocks'=>array('JqueryScriptsReady'=>null),
                                                      'helpers'=>array(
                                                "number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),  
                                  ),
     
                 'ajaxAdmin'=>array(
                                'blocks'=>array('JqueryScriptsReady'=>null)
                 ),
     
                "ajaxDialogListFilterMultipleSites"=>array(         
                    'blocks'=>array('JqueryScriptsReady'=>null),
               ),
); 
 
