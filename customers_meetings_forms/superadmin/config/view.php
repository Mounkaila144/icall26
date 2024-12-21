<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
        'ajaxNewFormI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewFormI18n'=>array(
                                    'template'=>"customers_meetings_forms_ajaxNewFormI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveFormI18n'=>array(
                                    'template'=>"customers_meetings_forms_ajaxViewFormI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     "ajaxSaveFormFields"=>array(
                "template"=>"customers_meetings_forms_ajaxFormFields.tpl",
     ),
     
    
 ); 
 
