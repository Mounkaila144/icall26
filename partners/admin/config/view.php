<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
      
     "ajaxNewPartner"=>array(
                      'widgets'=>array('select_country'=>''),    
                      'helpers'=>array('date'=>null),
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
       "ajaxViewPartner"=>array(
                      'widgets'=>array('select_country'=>''),       
                      'helpers'=>array('date'=>null),
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
         "ajaxSavePartner"=>array(
                      'template'=>'partners_ajaxViewPartner.tpl',
                      'helpers'=>array('date'=>null),
                      'widgets'=>array('select_country'=>''),                                                                      
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
 ); 
 
