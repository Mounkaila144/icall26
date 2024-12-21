<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null),
                          ),
     
       
     
         "ajaxSaveProduct"=>array(
                      'template'=>'products_ajaxViewProduct.tpl',                     
                   ),
     
      'ajaxSettingsProduct'=>array(                                    
                                     'functions'=>array('html_options_format'=>null),
                                    ), 
     
      'ajaxListTaxes'=>array('helpers'=>array("number"=>null),                                     
                           'security'=>array(
                                       "php_functions"=>array(
                                       "format_pourcentage"=>null,
                                            ),
                                                                     
                             ),
      ),
     
      'ajaxListPartialTaxes'=>array('helpers'=>array("number"=>null),                                     
                           'security'=>array(
                                       "php_functions"=>array(
                                       "format_pourcentage"=>null,
                                            ),
                                                                     
                             ),
       ),
     
      'ajaxNewTaxes'=>array('helpers'=>array("number"=>null),                                     
                           'security'=>array(
                                       "php_functions"=>array(
                                       "format_pourcentage"=>null,
                                            ),
                                                                     
                             ), 
      ), 
     
      'ajaxViewTaxes'=>array('helpers'=>array("number"=>null),                                     
                           'security'=>array(
                                       "php_functions"=>array(
                                       "format_pourcentage"=>null,
                                            ),
                                                                     
                             ), 
      ), 
     
      'ajaxSaveTaxes'=>array(
                                 "template"=>"products_ajaxViewTaxes.tpl",                                
                                 'helpers'=>array("number"=>null),
                                 'security'=>array(
                                                     "php_functions"=>array("format_pourcentage"=>null),
                                                   ),
                                 'functions'=>array('html_options_format'=>null),
                                                   
      ),   
     
       'ajaxListPartialProduct'=>array(                                                  
                          'functions'=>array('html_options_format'=>null),                          
      ),
     
      'ajaxListProduct'=>array(                                                  
                          'functions'=>array('html_options_format'=>null),                          
      ),
     
     
      'ajaxListAction'=>array('helpers'=>array("number"=>null),                                     
                           'security'=>array(
                                       "php_functions"=>array(
                                       "format_pourcentage"=>null,
                                            ),
                                                                     
                             ),
      ),
     
      'ajaxListPartialAction'=>array('helpers'=>array("number"=>null),                                     
                           'security'=>array(
                                       "php_functions"=>array(
                                       "format_pourcentage"=>null,
                                            ),
                                                                     
                             ),
       ),
     
         "ajaxSaveAction"=>array(
                      'template'=>'products_ajaxViewAction.tpl',                     
                   ),
 ); 
 
