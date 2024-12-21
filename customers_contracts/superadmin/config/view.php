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
                          'helpers'=>array("date"=>null,"number"=>null),
                           'functions'=>array('html_options_format'=>null),
                          'blocks'=>array("JqueryScriptsReady"=>""),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null                                                       
                                                ),
                           ), 
      ),
     
      'ajaxViewContract'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("number"=>null,"date"=>null),
                            'security'=>array(
                                    "php_functions"=>array("format_number"=>null,"format_date"=>null), 
                            ),
      ),
     
     
       'ajaxSaveContract'=>array(
                            'template'=>'customers_contracts_ajaxViewContract.tpl',
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>""),
                            'helpers'=>array("number"=>null,"date"=>null),
                                   'security'=>array(
                                         "php_functions"=>array("format_number"=>null,"format_date"=>null), 
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
     
     "ajaxSaveContractProduct"=>array(
            "template"=>"customers_contracts_ajaxViewContractProduct.tpl"
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
 ); 
 
