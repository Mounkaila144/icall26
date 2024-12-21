<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null),
                          ),
     
         "ajaxNewItemForProduct"=>array(
                     'helpers'=>array('number'=>null)
                   ),  
     
         "ajaxViewItemForProduct"=>array(
                     'helpers'=>array('number'=>null)
                   ),  
     
         "ajaxSaveItemForProduct"=>array(
                        'helpers'=>array('number'=>null),
                      'template'=>'products_items_ajaxViewItemForProduct.tpl',                     
                   ),
     
    /*  'ajaxSettingsProduct'=>array(                                    
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
                                                   
      ),  */ 
     
      'ajaxListPartialItemForProduct'=>array(                 
                            'helpers'=>array('number'=>null),
                          'functions'=>array('html_options_format'=>null),
           'security'=>array(
                                                     "php_functions"=>array("format_number"=>null),
                                                   ),    
      ),
     
     
     
 /*      'ajaxListProduct'=>array(   
                          'helpers'=>array('number'=>null),
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
                   ),*/
     
      'ajaxListPartialItem'=>array(                 
                            'helpers'=>array('number'=>null),            
                          'functions'=>array('html_options_format'=>null),   
           'security'=>array(
                                                     "php_functions"=>array("format_number"=>null),
                                                   ),    
                          ),   
     
       "ajaxMultipleProcessSelection"=>array(
         "template"=>"products_items_ajaxMultipleUpdateProcess.tpl",        
     ),
     
       "ajaxListMasterItems"=>array(
            'helpers'=>array('number'=>null),            
                          'functions'=>array('html_options_format'=>null),   
           'security'=>array(
                                                     "php_functions"=>array("format_number"=>null),
                                                   ),  
           "template"=>"./blocks/products_items_listMasterItems.tpl",  
        ),  
     
     
       "ajaxListSlaveItems"=>array(
            'helpers'=>array('number'=>null),            
                          'functions'=>array('html_options_format'=>null),   
           'security'=>array(
                                                     "php_functions"=>array("format_number"=>null),
                                                   ),  
           "template"=>"./blocks/products_items_listSlaveItems.tpl",  
        ), 
     
     
        'ajaxListPartialItemMasterSlave'=>array(                 
                'helpers'=>array('number'=>null),
                'functions'=>array('html_options_format'=>null),
                'security'=>array(
                 "php_functions"=>array("format_number"=>null),
                                                   ),    
        ),
     
        "ajaxNewItemMasterSlaveForProduct"=>array(
                     'helpers'=>array('number'=>null)
                   ),
     
        "ajaxViewItemMasterSlaveForProduct"=>array(
                     'helpers'=>array('number'=>null)
                   ),           
     
        "ajaxSaveItemMasterSlaveForProduct"=>array(
                        'helpers'=>array('number'=>null),
                     'template'=>'products_items_ajaxViewItemMasterSlaveForProduct.tpl',                  
                   ),
     
        "ajaxListItems"=>array(
            'helpers'=>array('number'=>null),            
                          'functions'=>array('html_options_format'=>null),   
           'security'=>array(
                                                     "php_functions"=>array("format_number"=>null),
                                                   ),  
           "template"=>"./blocks/products_items_listItems.tpl",  
        ), 
     
        "ajaxImportXMLProductItem"=>array(
            'helpers'=>array("number"=>null),                    
            "security"=>array("php_functions"=>array(                                            
                                "format_size"=>null
                            ),
                        ),
        ),
     
        "ajaxViewItemListMasterSlaveForProduct"=>array(
            'helpers'=>array("number"=>null),                               
        ),
     
        "ajaxSaveItemListMasterSlaveForProduct"=>array(
                                 "template"=>"products_items_ajaxViewItemListMasterSlaveForProduct.tpl",                                
                                 'helpers'=>array("number"=>null),
                                 'security'=>array(
                                                     "php_functions"=>array("format_pourcentage"=>null),
                                                   ),
                                 'functions'=>array('html_options_format'=>null),                        
        ),
     
         'ajaxListPartialItemMaster'=>array(                 
                'helpers'=>array('number'=>null),
                'functions'=>array('html_options_format'=>null),
                'security'=>array(
                 "php_functions"=>array("format_number"=>null),
                                                   ),    
        ),
     
        "ajaxNewItemListMasterSlaveForProduct"=>array(
                                 "template"=>"products_items_ajaxNewItemListMasterSlaveForProduct.tpl",                                
                                 'helpers'=>array("number"=>null),
                                 'security'=>array(
                                                     "php_functions"=>array("format_pourcentage"=>null),
                                                   ),
                                 'functions'=>array('html_options_format'=>null),                        
        ),
 ); 
 
