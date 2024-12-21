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
                            'helpers'=>array("date"=>null,'number'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null,'format_number'=>null), 
                            ),
      ),
     
     'ajaxNewMeetingForSchedule'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("date"=>null,'number'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
      'ajaxListPartialMeeting'=>array(                         
                          'helpers'=>array("date"=>null,'number'=>null),
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
                             'helpers'=>array("date"=>null,'number'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
      'ajaxViewMeeting2'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                             'helpers'=>array("date"=>null,'number'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
     'ajaxViewMeeting2ForSchedule'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                             'helpers'=>array("date"=>null,'number'=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
      'ajaxSaveMeeting'=>array(
                    'template'=>'customers_meetings_ajaxViewMeeting.tpl',
                    'functions'=>array('html_options_format'=>null),
                    'blocks'=>array("JqueryScriptsReady"=>""),
                    'helpers'=>array("date"=>null, "number"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null,'format_number'=>null), 
                            ),
      ),
     
      'ajaxSaveMeeting2'=>array(
                    'template'=>'customers_meetings_ajaxViewMeeting2.tpl',
                    'functions'=>array('html_options_format'=>null),
                    'blocks'=>array("JqueryScriptsReady"=>""),
                    'helpers'=>array("date"=>null, "number"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null,'format_number'=>null), 
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
     
       'ajaxEmailMeetingScheduleForSale'=>array(                         
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
     
     'ajaxSmsMeetingScheduleForSale'=>array(                         
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
     
      "ajaxMultipleUpdateProcess"=>array(
          'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
     "ajaxMultipleProcessSelection"=>array(
         "template"=>"customers_meetings_ajaxMultipleUpdateProcess.tpl",
         'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
     ),
     
      "ajaxCallbacks"=>array(
            "helpers"=>array("date"=>null),                     
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
     
       'ajaxNextMeeting'=>array(
               'template'=>'customers_meetings_ajaxViewMeeting.tpl',
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                             'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
       'ajaxPreviousMeeting'=>array(
            'template'=>'customers_meetings_ajaxViewMeeting.tpl',
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                             'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
      ),
     
      /* ===================== S T A T U S  C A L L ============================================ */  
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
     
     
     /* ===================== S T A T U S  L E A D ============================================ */  
       'ajaxNewStatusLeadI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewStatusLeadI18n'=>array(
                                    'template'=>"customers_meetings_ajaxNewStatusLeadI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveStatusLeadI18n'=>array(
                                    'template'=>"customers_meetings_ajaxViewStatusLeadI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
      /* ===================== T Y P E ============================================ */  
     
      'ajaxSaveNewTypeI18n'=>array(
                                    'template'=>"customers_meetings_ajaxNewTypeI18n.tpl",                                                                                                                                                      
                                                      
                 ), 
     
     'ajaxSaveTypeI18n'=>array(
                                    'template'=>"customers_meetings_ajaxViewTypeI18n.tpl",                                                                                                                   
                                                      
     ),
     
      /* ===================== C A M P A I G N ============================================ */  
     
    
     'ajaxSaveCampaign'=>array(
                                    'template'=>"customers_meetings_ajaxViewCampaign.tpl",                                                                                                                   
                                                      
     ),
     
     
      'ajaxDialogListFilterMeetings'=>array(                         
                          'helpers'=>array("date"=>null),                         
                          'functions'=>array('html_options_format'=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
     /* ================================= R A N G E ============================================================ */
     
       'ajaxSaveNewRangeI18n'=>array(
                                    'template'=>"customers_meetings_ajaxNewRangeI18n.tpl",                                                                                 
                              'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),          
                 ), 
     
     'ajaxSaveRangeI18n'=>array(
                                    'template'=>"customers_meetings_ajaxViewRangeI18n.tpl",                                                                                 
                             'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),                                               
                                                      
                 ), 
     
     
        'ajaxNewRangeI18n'=>array(
                                                                                                                 
                         'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),               
                 ), 
     
     'ajaxViewRangeI18n'=>array(
                                                                                                                 
                        'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),                                                    
                                                      
                 ), 
     
      'ajaxListRange'=>array(
                      'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),                                                 
                                                      
                 ), 
     
      'ajaxListPartialRange'=>array(
                      'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),                                                 
                                                      
                 ), 
     
     
     'ajaxListPartialMeetingScheduleRange'=>array(                         
                          'helpers'=>array("date"=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),                        
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
   /* ===================== B L O C K S ============================================ */  
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
     
      "_callbacks"=>array(
           
            "plugins"=>array(
                        "helpers"=>array("date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
     
     
     
       '_dialogListFilterMeetings'=>array(   
                "plugins"=>array(
                          'helpers'=>array("date"=>null,"number"=>null),
                          'functions'=>array('html_options_format'=>null),    
                    ),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null                                                       
                                                ),
                           ), 
      ),
     
     "_emailChangesForSale"=>array(
            "template"=>"./../emails/customers_meetings_emailChangesForSale.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
     
       /* ======================= COMPANY ============================================== */
     
      'ajaxListPartialCompany'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
    ),
     
      'ajaxListCompany'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
    ),
     
    'ajaxSaveCompany'=>array(
                                    'template'=>"customers_meetings_ajaxViewCompany.tpl",  
                                    'widgets'=>array('select_country'=>''),  
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null,"format_postal_code"=>''),),                                     
                                                      
   ), 
     
      "ajaxViewCompany"=>array(
                      'widgets'=>array('select_country'=>''),                                                                      
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
       "ajaxNewCompany"=>array(
                      'widgets'=>array('select_country'=>''),                                                                      
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
          /* ======================= MEETING2 ============================================== */
     
      'ajaxListPartialMeeting2'=>array(                         
                          'helpers'=>array("date"=>null,'number'=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'functions'=>array('html_options_format'=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
      ),
     
     "ajaxListPartialScheduleForList"=>array(                         
                          'helpers'=>array("date"=>null,'number'=>null),
                         // 'blocks'=>array("JqueryScriptsReady"=>""),
                          'functions'=>array('html_options_format'=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
      ),
 ); 
 
