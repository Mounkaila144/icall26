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
                                    'template'=>"customers_contracts_ajaxNewStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxViewStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxListPartialContract'=>array(                         
                          'helpers'=>array("date"=>null,"number"=>null,'module'=>null),
                          'functions'=>array('html_options_format'=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null ,
                                                   "isModuleInstalled"=>null
                                                ),
                           ), 
      ),
     
      'ajaxViewContract'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("number"=>null,"date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_number"=>null,"format_date"=>null,'format_pourcentage'=>null,'format_currency'=>null), 
                            ),
      ),
     
     
       'ajaxSaveContract'=>array(
                            'template'=>'customers_contracts_ajaxViewContract.tpl',
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("number"=>null,"date"=>null),
                                   'security'=>array(
                                         "php_functions"=>array("format_number"=>null,"format_date"=>null,'format_pourcentage'=>null,'format_currency'=>null), 
                            ),
      ),
     
     'ajaxEmailContract'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
      'ajaxSmsContract'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
     "ajaxSaveAttributions"=>array(
                "template"=>"customers_contracts_ajaxModifyAttributions.tpl",
     ),
     
      "ajaxSaveAttributions2"=>array(
                "template"=>"customers_contracts_ajaxModifyAttributions2.tpl",
          'helpers'=>array("date"=>null),                         
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
     ),
         
     
     "ajaxSaveContractProduct"=>array(
            "template"=>"customers_contracts_ajaxViewContractProduct.tpl",
            'helpers'=>array("number"=>null),                     
     ),
     
         'ajaxDialogListFilterContracts'=>array(                 
                          'helpers'=>array("date"=>null,"number"=>null),
                          'functions'=>array('html_options_format'=>null),                      
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null                                                       
                                                ),
                           ), 
      ),
     
     "_email"=>array(
            "template"=>"./../emails/customers_contracts_email.tpl",
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
            "template"=>"./../emails/customers_contracts_sms.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
       'ajaxEmailContractForSale'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
        'ajaxSmsContractForSale'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
      ),
     
       "_emailForSale"=>array(
            "template"=>"./../emails/customers_contracts_emailForSale.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
       "_emailChangesForSale"=>array(
            "template"=>"./../emails/customers_contracts_emailChangesForSale.tpl",
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
            "template"=>"./../emails/customers_contracts_smsForSale.tpl",
            "plugins"=>array(
                        "helpers"=>array('number'=>null,"date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null,"format_number"=>null
                                  ),
                  ),   
     ),
     
       '_dialogListFilterContracts'=>array(   
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
     
      'ajaxNewContract'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),                            
                            'helpers'=>array("number"=>null,"date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_number"=>null,"format_date"=>null,'format_pourcentage'=>null), 
                            ),
                            
      ),
     
     "_listProductsForContract"=>array(
          "plugins"=>array(
                          'helpers'=>array("number"=>null,'date'=>null),                                                          
                    ),                         
          'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),         
     ),
     
     "ajaxListContractProduct"=>array(         
                          'helpers'=>array("number"=>null,'date'=>null),
          'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),  
     ),
     
     "ajaxViewContractProduct"=>array(
                    'helpers'=>array("number"=>null,'date'=>null),   
                    'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),                    
     ),
     
       "ajaxNewContractProduct"=>array(            
            'helpers'=>array("number"=>null,'date'=>null),   
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
         "template"=>"customers_contracts_ajaxMultipleUpdateProcess.tpl",
         'helpers'=>array("date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_date"=>null), 
                            ),
     ),
     
     /* ========================== I n s t a l l  S t a t u s ========================================================================== */
     
         'ajaxNewInstallStatusI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewInstallStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxNewInstallStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveInstallStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxViewSInstallStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
      /* ========================== T I M E  S t a t u s ========================================================================== */
     
         'ajaxNewTimeStatusI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewTimeStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxNewTimeStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveTimeStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxViewTimeStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     /* ======================================RANGE =================================================== */
            
     
      'ajaxSaveNewRangeI18n'=>array(
                                    'template'=>"customers_contracts_ajaxNewRangeI18n.tpl",                                                                                 
                              'helpers'=>array("time"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_from_time"=>null), 
                            ),          
                 ), 
     
     'ajaxSaveRangeI18n'=>array(
                                    'template'=>"customers_contracts_ajaxViewRangeI18n.tpl",                                                                                 
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
     
     
      /* ========================== O P C  S t a t u s ========================================================================== */
     
         'ajaxNewOpcStatusI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewOpcStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxNewOpcStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveOpcStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxViewSOpcStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     /* ========================== ADMIN  S t a t u s ========================================================================== */
     
         'ajaxNewAdminStatusI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewAdminStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxNewAdminStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveAdminStatusI18n'=>array(
                                    'template'=>"customers_contracts_ajaxViewAdminStatusI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
    "_ListFilterContract" =>array("plugins"=>array(
                          'helpers'=>array("date"=>null,"number"=>null,'module'=>null),
                          'functions'=>array('html_options_format'=>null),          
                          'blocks'=>array("JqueryScriptsReady"=>""),
                    ),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null,
                                                   "isModuleInstalled"=>null
                                                ),
                           ), 
     ),
     
     
      'ajaxListPartialFilterContract'=>array(                         
                          'helpers'=>array("date"=>null,"number"=>null,'module'=>null),
                          'functions'=>array('html_options_format'=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null ,
                                                   "isModuleInstalled"=>null
                                                ),
                           ), 
      ),
     
     "ajaxListAttributions"=>array(                         
                          'helpers'=>array("date"=>null),                         
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
      ),
     
     
      "ajaxListAttributions2"=>array(                         
                          'helpers'=>array("date"=>null),                         
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
      ),
     
     "ajaxModifyAttributions2"=>array(                         
                          'helpers'=>array("date"=>null),                         
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
      ),
     
     "ajaxMultipleProcessAttributionSelection"=>array(                         
                          'helpers'=>array("date"=>null),                         
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,
                                                ),
                           ), 
      ),
     
     /* ======================= ZONE ============================================== */
     
      'ajaxListPartialZone'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
    ),
     
      'ajaxListZone'=>array(                         
                          'helpers'=>array("date"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                       
                                                ),
                           ), 
    ),
     
    'ajaxSaveZone'=>array(
                                    'template'=>"customers_contracts_ajaxViewZone.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
   ), 
     
     
      'ajaxListPartialDatesContract'=>array(                         
                          'helpers'=>array("date"=>null,"number"=>null,'module'=>null),
                          'functions'=>array('html_options_format'=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null ,
                                                   "isModuleInstalled"=>null
                                                ),
                           ), 
      ),
     
     
     
     "ajaxViewDateFieldForContract"=>array(               
          'helpers'=>array("date"=>null),                                                   
     ),
     
      "ajaxEditDateFieldForContract"=>array(               
          'helpers'=>array("date"=>null),                                                   
     ),
     
       "ajaxSaveDateFieldForContract"=>array(               
          'helpers'=>array("date"=>null),                                                   
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
                                    'template'=>"customers_contracts_ajaxViewCompany.tpl",                                                                                 
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
     
     'ajaxListPartialContract2'=>array(                         
                          'helpers'=>array("date"=>null,"number"=>null,'module'=>null),
                          'functions'=>array('html_options_format'=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null ,
                                                   "isModuleInstalled"=>null
                                                ),
                           ), 
      ),
 ); 
 