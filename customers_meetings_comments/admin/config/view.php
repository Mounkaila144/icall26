<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null),
                          ),
     
     "ajaxListPartialComment"=>array(                        
            "helpers"=>array("date"=>null),                          
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
      "ajaxListPartialLogComment"=>array(                        
            "helpers"=>array("date"=>null),                          
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
     "_list"=>array(            
            "plugins"=>array(
                        "helpers"=>array("date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
      "_listLog"=>array(            
            "plugins"=>array(
                        "helpers"=>array("date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
      "ajaxListPartialCommentForContract"=>array(                        
            "helpers"=>array("date"=>null),                          
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
     
      "_listForContract"=>array(            
            "plugins"=>array(
                        "helpers"=>array("date"=>null),
                            ),
            "security"=>array(
                   "php_functions"=>array(
                                   "format_date"=>null
                                  ),
                  ),   
     ),
 ); 
 