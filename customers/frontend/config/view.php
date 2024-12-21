<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null),
                          ),
     
        'signin'=>array(     
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery/1.11.1/jquery-1.11.1.min.js'=>null,
                                                   'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),                                                
                                                   'ui/jquery-ui.min.js'=>null,
                                                 ),                                                           
                             'title'=>"Signin", 
                             'functions'=>array('html_options_format'=>null),
                             'widgets'=>array("banner"=>null,),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),  
     
        'login'=>array(     
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery/1.11.1/jquery-1.11.1.min.js'=>null),                                
                           //  'javascripts'=>array('jquery-1.7.min.js'=>null),
                             'title'=>"Login", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),  
     
      'account'=>array(     
                            'layout'=>array(
                                        "template"=>"default.xml",
                                        ),
                             'stylesheets'=>array("main.css"=>null, 
                                                  "awesome/4.7.0/css/font-awesome.min.css"=>null,
                                                 "ui/1.11.0/jquery-ui.min.css"=>null,     ),
                             'javascripts'=>array('jquery/1.11.1/jquery-1.11.1.min.js'=>null, 
                                                    'jquery.custom.js'=>null,
                                                   'jquery.custom.messages.js'=>array("type"=>"url"),                                                
                                                   'ui/jquery-ui.min.js'=>null,
                                 'highcharts.js'=>array('module'=>'highcharts'),
                                 ),                                                        
                             'title'=>"My account", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),  
              
      'forgotPassword'=>array(
                         'title'=>"My Account - Forgot password",
                         "layout"=>array("template"=>"default.xml"),
                         'widgets'=>array("banner"=>null,"messages"=>null),     
                        'stylesheets'=>array("main.css"=>null,
                                                    "themes/base/jquery.ui.all.css"=>null
                                                   ),
                    
                                'javascripts'=>array(
                                        'jquery/1.11.1/jquery-1.11.1.min.js'=>null,
                                        'jquery.custom.js'=>null,
                                        'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                    ), 
                    ),
     
      'forgotPasswordConfirm'=>array(
                        'title'=>"My Account - Forgot password",
                      //   "layout"=>array("template"=>"default.xml"),
                         'widgets'=>array("banner"=>null,"messages"=>null),     
                        'stylesheets'=>array("main.css"=>null,
                                                    "themes/base/jquery.ui.all.css"=>null
                                                   ),
                    
                                'javascripts'=>array(
                                        'jquery/1.11.1/jquery-1.11.1.min.js'=>null,
                                        'jquery.custom.js'=>null,
                                        'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                    ), 
                    ),
                        
      'forgotPasswordSent'=>array(
                        'title'=>"My Account - Forgot password",
                       //  "layout"=>array("template"=>"default.xml"),
                         'widgets'=>array("banner"=>null,"messages"=>null),     
                        'stylesheets'=>array("main.css"=>null,
                                                    "themes/base/jquery.ui.all.css"=>null
                                                   ),
                    
                                'javascripts'=>array(
                                        'jquery/1.11.1/jquery-1.11.1.min.js'=>null,
                                        'jquery.custom.js'=>null,
                                        'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                    ), 
                    ),
     
      'ConfirmAccount'=>array(
                         'title'=>"My Account - Confirmation",
                         "layout"=>array("template"=>"default.xml"),
                         'widgets'=>array("banner"=>null,"messages"=>null),     
                        'stylesheets'=>array("main.css"=>null,
                                                    "themes/base/jquery.ui.all.css"=>null
                                                   ),
                    
                                'javascripts'=>array(
                                        'jquery/1.11.1/jquery-1.11.1.min.js'=>null,
                                        'jquery.custom.js'=>null,
                                        'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                    ), 
                    ),
     
      
     
     'address'=>array(     
                            'layout'=>array(
                                        "template"=>"default.xml",
                                        ),
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery-1.11.1.min.js'=>null),                                
                           //  'javascripts'=>array('jquery-1.7.min.js'=>null),
                             'title'=>"My account - Address", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ), 
     
      'accountCreated'=>array(     
                            'layout'=>array(
                                        "template"=>"default.xml",
                                        ),
                             'stylesheets'=>array("main.css"=>null),
                             'javascripts'=>array('jquery/1.11.1/jquery-1.11.1.min.js'=>null),                                
                           //  'javascripts'=>array('jquery-1.7.min.js'=>null),
                             'title'=>"My account", 
                             'widgets'=>array("banner"=>null),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                             ),  
     
      "ajaxMyAccount"=>array(
                 'helpers'=>array("number"=>null),      
                // 'functions'=>array('html_options_format'=>''),
                // 'widgets'=>array('select_country'=>''), 
                 "security"=>array("php_functions"=>array(
                                           // 'format_postal_code'=>'', 
                                           // 'html_options_format'=>'',  
                                           // 'format_state'=>'',
                                            "format_size"=>null
                                                 ),
                                ),
     ),
     
      "ajaxSaveMyAccount"=>array(
                 'template'=>'customers_ajaxMyAccount.tpl',
                 'helpers'=>array("number"=>null),      
                // 'functions'=>array('html_options_format'=>''),
                // 'widgets'=>array('select_country'=>''), 
                 "security"=>array("php_functions"=>array(
                                           // 'format_postal_code'=>'', 
                                           // 'html_options_format'=>'',  
                                           // 'format_state'=>'',
                                            "format_size"=>null
                                                 ),
                                ),
     ),
     
      "ajaxMyAddresses"=>array(
            "helpers"=>array("degree"=>"","date"=>""),
            "security"=>array("php_functions"=>array(
                                            'format_dec_to_dms'=>'','format_date'=>''                                                                           
                                                 ),
                                ),
     ),
     
       "ajaxSaveMyLanguages"=>array(
                 'template'=>'customers_ajaxMyLanguages.tpl',
     ),
     
     
      "ajaxSaveUserForCompany"=>array(
                 'template'=>'customers_ajaxViewUserForCompany.tpl',                
     ),
     
      "ajaxListUserForCompany"=>array(
          "helpers"=>array("date"=>""),
            "security"=>array("php_functions"=>array(
                                           'format_date'=>''                                                                           
                                                 ),
                                ),
     ),
     
     "ajaxListPartialUserForCompany"=>array(
          "helpers"=>array("date"=>""),
            "security"=>array("php_functions"=>array(
                                           'format_date'=>''                                                                           
                                                 ),
                                ),
     )
 ); 
 
