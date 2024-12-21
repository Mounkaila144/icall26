<?php
// key = [action][view]
return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>null),
                          ),
    
     'themesList'=>array(
                            'layout'=>array(
                                        "template"=>"layout_dashboard.xml",
                                       // "is_secure"=>true,
                                        ),
                             'widgets'=>array("banner"=>null),
                            'title'=>'dashboard | themes ',
                            'stylesheets'=>array("main.css"=>null),
                            'javascripts'=>array('jquery-1.7.min.js'=>null,
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                ),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                            'functions'=>array('html_options_format'=>null)
                          ),  
    
    "ajaxList"=>array(
                        'blocks'=>array("JqueryScriptsReady"=>null),
                        'functions'=>array('html_options_format'=>null)
    ),
    
    "ajaxListPartial"=>array(
                        'blocks'=>array("JqueryScriptsReady"=>null),
                        'functions'=>array('html_options_format'=>null)
    ),
    
    'ajaxListTheme'=>array(
                        'blocks'=>array('JqueryScriptsReady'=>null),                                                                
    ),
                                  
    'ajaxListPartialTheme'=>array(
                        'blocks'=>array('JqueryScriptsReady'=>null),
                        
    ),     
    
); 
