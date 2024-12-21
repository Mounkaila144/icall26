<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
       'ajaxListPartial'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
           'helpers'=>array(
                                                "date"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null),),  
                       ), 
     'ajaxNewRegistration'=>array(
                            "template"=>"utils_registration_ajaxListRegistration.tpl",
                            'helpers'=>array( "number"=>null),
                                   'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_currency"=>null),
                                       ), 
     ),
     
     
     
 ); 
 
