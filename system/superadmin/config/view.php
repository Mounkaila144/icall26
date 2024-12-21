<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                           
                           'widgets'=>array('messages'=>null),                                           
                          ),
     
      'ajaxSystem'=>array(
             'blocks'=>array('JqueryScriptsReady'=>null),
                                    'helpers'=>array("number"=>null),                
                                    "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>'',"format_size"=>'',
                                                   ),
                                   ),
                            ),
); 
 
