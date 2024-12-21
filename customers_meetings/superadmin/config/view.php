<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
       'ajaxNewStatusI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewStatusI18n'=>array(
                                    'template'=>"customers_meetings_ajaxNewStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveStatusI18n'=>array(
                                    'template'=>"customers_meetings_ajaxViewStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxNewMeeting'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
      'ajaxListPartialMeeting'=>array(                         
                          'helpers'=>array("date"=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'functions'=>array('html_options_format'=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
      'ajaxViewMeeting'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                             'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
      'ajaxSaveMeeting'=>array(
                    'template'=>'customers_meetings_ajaxViewMeeting.tpl',
                    'functions'=>array('html_options_format'=>null),
                    'blocks'=>array("JqueryScriptsReady"=>""),
                    'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
     'ajaxSaveMeetingProduct'=>array(
                    'template'=>'customers_meetings_ajaxViewMeetingProduct.tpl',
     ),
     
      'ajaxEmailMeeting'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
     'ajaxEmailMeetingForSale'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
      'ajaxSmsMeeting'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
     'ajaxSmsMeetingForSale'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
      'ajaxListPartialMeetingSchedule'=>array(                         
                          'helpers'=>array("date"=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),                        
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
      'ajaxViewMeetingSchedule'=>array(
                            'functions'=>array('html_options_format'=>null),                        
                            'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
     /* ================================================================================================== */
     
     'ajaxNewStatusCallI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewStatusCallI18n'=>array(
                                    'template'=>"customers_meetings_ajaxNewStatusCallI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveStatusCallI18n'=>array(
                                    'template'=>"customers_meetings_ajaxViewStatusCallI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     /* ================================================================================================== */
     
      "_email"=>array(
            "template"=>"./../emails/customers_meetings_email.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
      "_emailForSale"=>array(
            "template"=>"./../emails/customers_meetings_emailForSale.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
     "_sms"=>array(
            "template"=>"./../emails/customers_meetings_sms.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
     "_smsForSale"=>array(
            "template"=>"./../emails/customers_meetings_smsForSale.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
 ); 
 
