<?php

// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                           
                          ),
    
        'error404'=>array('title'=>"Page not found",
                       "layout"=>array("template"=>"default.xml"),                              
                      'widgets'=>array("banner"=>null,"messages"=>null),     
                       'stylesheets'=>array("main.css"=>null,
                                            "themes/base/jquery.ui.all.css"=>null
                                           ),

                        'javascripts'=>array(
                                'jquery-1.11.1.min.js'=>null,
                                'jquery.custom.js'=>null,
                                'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                            ), 


            ),

        'index'=>array('title'=>"Home",
                    //   "layout"=>array("template"=>"default_index.xml"),                 
                       'widgets'=>array("banner"=>null,"messages"=>null),
                       'stylesheets'=>array("main.css"=>null,
                                            "themes/base/jquery.ui.all.css"=>null
                                           ),
                        'metas'=>array("description"=>"","keywords"=>""),                                            
                        'javascripts'=>array(
                                'jquery-1.11.1.min.js'=>null,
                                'jquery.custom.js'=>null,
                                'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                            ), 
                         'blocks'=>array("JqueryScriptsReady"=>null),      
                      ),
     
        'login'=>array(
                          'javascripts'=>array('jquery-1.4.2.min.js'=>null), 
                          'stylesheets'=>array("main.css"=>null),
                          'title'=>"Login", // %actionName%
                          'metas'=>array(
                                        "description"=>"super web",
                                        "keywords"=>"key1,key2...",
                                   ),                                  
                          ),
                
        "siteNotAvailable"=>array('title'=>"Site is not available",
                              'layout'=>array("template"=>"site_not_available.xml"),                 
                               'widgets'=>array("banner"=>null,"messages"=>null),
                               'stylesheets'=>array("main.css"=>null,
                                                    "themes/base/jquery.ui.all.css"=>null
                                                   ),
                    
                                'javascripts'=>array(
                                        'jquery-1.11.1.min.js'=>null,
                                        'jquery.custom.js'=>null,
                                        'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                    ), 
                                                
    ),
  
 ); 
 
