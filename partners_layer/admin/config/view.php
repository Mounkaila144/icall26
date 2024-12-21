<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
   
	 
      
     
        'ajaxSaveLayerCompany'=>array(
                                    'template'=>"partners_layer_ajaxViewLayerCompany.tpl",                                                                                 
                                'helpers'=>array('degree'=>null,'date'=>null),
                                                      
        ),
     
          "ajaxNewLayerCompany"=>array(
                      'widgets'=>array('select_country'=>'','date'=>null),                                                                      
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
          "ajaxNewLayer"=>array(
                      'widgets'=>array('select_country'=>''),  
                 'helpers'=>array('degree'=>null),
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
            "ajaxViewLayerCompany"=>array(
                      'widgets'=>array('select_country'=>null,),       
                        'helpers'=>array('degree'=>null,'date'=>null),
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
     
       "ajaxListPartialLayerCompany"=>array(                       
                        'helpers'=>array('degree'=>null),                   
                   ),
     
     "ajaxListLayerCompany"=>array(                   
                        'helpers'=>array('degree'=>null),                   
                   ),
    
 ); 
 