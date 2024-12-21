<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
    
            'ajaxImportFromSite'=>array(
                                                                        
                                     'helpers'=>array("date"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,),                                     
                                       ),              
                 ), 
     
       'ajaxImportStartFromSite'=>array(
                                                                        
                                     'helpers'=>array("date"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,),                                     
                                       ),              
                 ), 
 ); 
 
