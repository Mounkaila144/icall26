<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
       'ajaxListPartial'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                       ),    
     
     /* ========================== UNION ======================================================== */
     
     
      'ajaxSaveNewUnionI18n'=>array(
                                    'template'=>"customers_ajaxNewUnionI18n.tpl",                                                                                 
                                    
      ), 
     
     'ajaxSaveUnionI18n'=>array(
                                    'template'=>"customers_ajaxViewUnionI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     "ajaxSaveCustomerForContract"=>array(
                    "template"=>"customers_ajaxModifyCustomerForContract.tpl"
     ),
 ); 
 
