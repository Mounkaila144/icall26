<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>array()),
                          ),
     
    
    'ajaxListText'=>array(                   
                  
                   'helpers'=>array(
                              "date"=>null,                                                 
                            ),
                   'security'=>array(
                           "php_functions"=>array(
                              "format_date"=>null,                                                                                                                                                                                                                       
                           ),
                    ), 
   ),
                                  
    'ajaxListPartialText'=>array(
                    
                    'helpers'=>array(
                               "date"=>null,                                                 
                             ),                                                
                    'security'=>array(
                            "php_functions"=>array(
                               "format_date"=>null,                                                                                                                                                            
                                                                                                                        
                             ),
                     ),                                                 
    ),
     
     
    "ajaxSaveText"=>array(
                "template"=>"site_text_ajaxViewText.tpl",
    ),      
    
   
   
    
      'ajaxImportText'=>array(                                                                                       
                                     'helpers'=>array(
                                                "number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ),
    
); 
 
