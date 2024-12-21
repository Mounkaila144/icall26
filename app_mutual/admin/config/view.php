<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
    
    /* PARTNER */
    'ajaxListMutualPartner'=>array(
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
    
    'ajaxListPartialMutualPartner'=>array(
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
     
    "ajaxNewMutualPartner"=>array(
        'widgets'=>array('select_country'=>''),                                                                      
        'security'=>array(
                     "php_functions"=>array("format_postal_code"=>'')
                    ),
    ),
     
    "ajaxViewMutualPartner"=>array(
        'widgets'=>array('select_country'=>''),                                                                      
        'security'=>array(
                        "php_functions"=>array("format_postal_code"=>'')
                    ),
    ),
     
    "ajaxSaveMutualPartner"=>array(
        'template'=>'app_mutual_ajaxViewMutualPartner.tpl',
        'widgets'=>array('select_country'=>''),                                                                      
        'security'=>array(
                        "php_functions"=>array("format_postal_code"=>'')
                    ),
    ),
    
    /* PRODUCT */
    
    'ajaxListMutualProduct'=>array(
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
     
    'ajaxListPartialMutualProduct'=>array(
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
     
    'ajaxNewMutualProduct'=>array(
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
   
    'ajaxViewMutualProduct'=>array(
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
   
    'ajaxSaveMutualProduct'=>array(
        'template'=>"app_mutual_ajaxViewMutualProduct.tpl",
        'helpers'=>array('number'=>null),
        'security'=>array(
            'php_functions'=>array(
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        )
    ),
   
    /*Commission*/
    'ajaxListMutualProductCommission'=>array(
        'helpers'=>array('number'=>null,'date'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ), 
    'ajaxListPartialMutualProductCommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
    'ajaxNewMutualProductCommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
    'ajaxViewMutualProductCommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
    'ajaxSaveMutualProductCommission'=>array(
        'template'=>"app_mutual_ajaxViewMutualProductCommission.tpl",
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
   
    'ajaxListMutualProductDecommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ), 
     
    /*Decommission*/
    'ajaxListPartialMutualProductDecommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ), 
    'ajaxNewMutualProductDecommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
    'ajaxViewMutualProductDecommission'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
    'ajaxSaveMutualProductDecommission'=>array(
        'template'=>"app_mutual_ajaxViewMutualProductDecommission.tpl",
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=> array(
            'php_functions'=>array(
                'format_date'=>'',
                'format_pourcentage'=>'',
            )
        )
    ),
    
    /* Mutual Contact*/
    "ajaxSaveMutualPartnerContact"=>array(
        'template' => 'app_mutual_ajaxViewMutualPartnerContact.tpl',
    ),
    
    /* Mutual Params*/
    "ajaxViewMutualParams"=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                        "php_functions"=>array(
                            "format_date"=>null,
                            'format_pourcentage'=>null,
                            'format_currency'=>null,
                        )
                    ),
    ),
     
    "ajaxSaveMutualParams"=>array(
        'template' => 'app_mutual_ajaxViewMutualParams.tpl',
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                        "php_functions"=>array(
                            "format_date"=>null,
                            'format_pourcentage'=>null,
                            'format_currency'=>null,
                        )
                    ),
    ),
    
    /* EngineCalculation */
    'ajaxListPartialMutualMeetingCalculation'=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_date"=>null,
                        'format_pourcentage'=>null,
                        'format_currency'=>null,
                    )
                ),
    ),
     
    'ajaxListMutualMeetingCalculation'=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_date"=>null,
                        'format_pourcentage'=>null,
                        'format_currency'=>null,
                    )
                ),
    ),
     
    'ajaxStartMutualCalculationForMeeting'=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_date"=>null,
                        'format_pourcentage'=>null,
                        'format_currency'=>null,
                    )
                ),
    ),
     
    '_CalculationForMeeting'=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_date"=>null,
                        'format_pourcentage'=>null,
                        'format_currency'=>null,
                    )
                ),
    ),     
     
    '_CalculationForViewMeeting'=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_date"=>null,
                        'format_pourcentage'=>null,
                        'format_currency'=>null,
                    )
                ),
    ),
     
    'ajaxStartMutualCalculationForViewMeeting'=>array(
        'helpers' => array('date'=>null,'number'=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_date"=>null,
                        'format_pourcentage'=>null,
                        'format_currency'=>null,
                    )
                ),
    ),
     
    /* Meeting products */
    'ajaxSaveNewProductForMeeting'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=>array(
            "php_functions"=>array(
                'format_date'=>null,
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        ),
    ),
     
    'ajaxViewProductForMeeting'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=>array(
            "php_functions"=>array(
                'format_date'=>null,
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        ),
    ),
     
    'ajaxCancelMutualProductForViewMeeting'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=>array(
            "php_functions"=>array(
                'format_date'=>null,
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        ),
    ),
     
    'ajaxUpdateProductForViewMeeting'=>array(
        'helpers'=>array('date'=>null,'number'=>null),
        'security'=>array(
            "php_functions"=>array(
                'format_date'=>null,
                'format_pourcentage'=>null,
                'format_currency'=>null,
            )
        ),
    ),
); 
 
