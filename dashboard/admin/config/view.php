<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>null),
                          ),  
     
    'index'=>array(
                   "layout"=>array(
                            "template"=>"layout_dashboard.xml",
                           // "is_secure"=>true,
                            ),
                    'blocks'=>array('JqueryScriptsReady'=>null),
                              'functions'=>array('html_options_format'=>null), // Mandatory
                              'stylesheets'=>array("ui/jquery-ui.min.css"=>null,
                                                 //  "bootstrap/3.0.1/bootstrap.min.css"=>null,    
                                                    /* added */
                                               //    "bootstrap/3.0.1/bootstrap.min.css"=>null,                                  
                                               //    "bootstrap-select/1.12.4/bootstrap-select.min.css"=>null,                                  
                                               //    "bootstrap-select/1.12.4/less/bootstrap-select.less"=>null,                                  
                                               //    "bootstrap-select/1.12.4/sass/bootstrap-select.scss"=>null,  
                                                   /**/
                                                "dropzone/4.1.0/dropzone.min.css"=>null,
                                                   "font-awesome-4.2.0/css/font-awesome.min.css"=>null,
                                                   "main.css"=>null,  
                                                   "sidebar/slidebar.css"=>null
                                                  ),
                              'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                   'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),                                                
                                                   'ui/jquery-ui.min.js'=>null,
                                    "dropzone/4.1.0/dropzone.js"=>null,  
                                                   'sidebar/slidebar.js'=>null,
                                                //   'bootstrap/3.0.1/bootstrap.min.js'=>null
                                                    /* added */
                                              //      'bootstrap/3.0.1/bootstrap.min.js'=>null,
                                              //      'bootstrap-select/1.12.4/bootstrap-select.min.js'=>null,
                                              //      'md5/jquery.md5.min.js'=>null,
                                                    /**/
                                                  ),    
                  ),

    "error404"=>array(
        'title'=>'page not found',
        'stylesheets'=>array("main.css"=>null),
    ),
     
    "_menu"=>array(
        "plugins"=>array(
                        'blocks'=>array('JqueryScriptsReady'=>null),
            ),
    ),
     
     "_notificationsManager"=>array(
        "plugins"=>array(
                        'blocks'=>array('JqueryScriptsReady'=>null),
            ),
    ),
     
      'ajaxSaveNewSystemMenu'=>array(
                  'template'=>"dashboard_ajaxNewSystemMenu.tpl",                                                                                 
                  'helpers'=>array('number'=>null)                                     
                                                      
      ), 
     
         'settings'=>array(
                   "layout"=>array(
                            "template"=>"layout_dashboard.xml",
                           // "is_secure"=>true,
                            ),
                    'blocks'=>array('JqueryScriptsReady'=>null),
                              'functions'=>array('html_options_format'=>null), // Mandatory
                              'stylesheets'=>array("ui/jquery-ui.min.css"=>null,
                                                 //  "bootstrap/3.0.1/bootstrap.min.css"=>null,    
                                                    /* added */
                                               //    "bootstrap/3.0.1/bootstrap.min.css"=>null,                                  
                                               //    "bootstrap-select/1.12.4/bootstrap-select.min.css"=>null,                                  
                                               //    "bootstrap-select/1.12.4/less/bootstrap-select.less"=>null,                                  
                                               //    "bootstrap-select/1.12.4/sass/bootstrap-select.scss"=>null,  
                                                   /**/
                                                "dropzone/4.1.0/dropzone.min.css"=>null,
                                                   "font-awesome-4.2.0/css/font-awesome.min.css"=>null,
                                                   "main.css"=>null,  
                                                   "sidebar/slidebar.css"=>null
                                                  ),
                              'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                   'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),                                                
                                                   'ui/jquery-ui.min.js'=>null,
                                    "dropzone/4.1.0/dropzone.js"=>null,  
                                                   'sidebar/slidebar.js'=>null,
                                                //   'bootstrap/3.0.1/bootstrap.min.js'=>null
                                                    /* added */
                                              //      'bootstrap/3.0.1/bootstrap.min.js'=>null,
                                              //      'bootstrap-select/1.12.4/bootstrap-select.min.js'=>null,
                                              //      'md5/jquery.md5.min.js'=>null,
                                                    /**/
                                                  ),    
                  ),
); 
 
