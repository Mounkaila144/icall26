<?php
// key = [action][view]
 return array('all'=>array( 'classView'=>'SmartyView',
                          ),    
     
     
      'ajaxViewTextEmailI18n'=>array(
                               'widgets'=>array('messages'=>null),
                               'blocks'=>array('JqueryScriptsReady'=>null),   
                               "javascripts"=>array(
                                                     "tiny_mce/3.4.6/jquery.tinymce.js"=>array("async"=>false),  
                                                   ),
                                
     ),   
     
      "ajaxListTextEmailI18n"=>array(      
                            'widgets'=>array('messages'=>null),
                            'template'=>"./blocks/utils_listTextEmailI18n.tpl",
                            'functions'=>array(
                                          'html_options_format'=>null, 
                                              ),                    
     ),   
     
     'ajaxSaveTextEmailI18n'=>array(
                                'widgets'=>array('messages'=>null),
                               'blocks'=>array('JqueryScriptsReady'=>null),   
                               'template'=>"utils_ajaxViewTextEmailI18n.tpl",                                        
     ),   
     
      'ajaxNewTextEmailI18n'=>array(
                                'widgets'=>array('messages'=>null),
                               'blocks'=>array('JqueryScriptsReady'=>null),   
                                "javascripts"=>array(
                                                     "tiny_mce/3.4.6/jquery.tinymce.js"=>array("async"=>false),  
                                                   ),
     ),   
     
      "ajaxListTextI18n"=>array(   
                            'widgets'=>array('messages'=>null),
                            'template'=>"./blocks/utils_listTextI18n.tpl",
                            'functions'=>array(
                                          'html_options_format'=>null, 
                                              ),                    
     ),  
     
     'ajaxViewTextI18n'=>array(
                                'widgets'=>array('messages'=>null),
                               'blocks'=>array('JqueryScriptsReady'=>null),   
                               "javascripts"=>array(
                                                           "tiny_mce/3.4.6/jquery.tinymce.js"=>array("async"=>false),  
                                                   ),
                                
     ),      
    
    
     'ajaxSaveTextI18n'=>array(
                                'widgets'=>array('messages'=>null),
                               'blocks'=>array('JqueryScriptsReady'=>null),   
                               'template'=>"utils_ajaxViewTextI18n.tpl",                               
     ),      
            
                          
     'ajaxNewTextI18n'=>array(   'widgets'=>array('messages'=>null),
                               'blocks'=>array('JqueryScriptsReady'=>null),   
                               "javascripts"=>array(
                                                     "tiny_mce/3.4.6/jquery.tinymce.js"=>array("async"=>false),  
                                                   ),                                
     ),   
     
      "_dialogFileManagerFtpForImport"=>array(
        "plugins"=>array('helpers'=>array('number'=>null,"date"=>null),
                         'blocks'=>array('JqueryScriptsReady'=>'')),
                         'security'=>array("php_functions"=>array("format_size"=>'',"format_date"=>null)
                        ),
    ),
); 
 
