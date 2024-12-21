<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>null,"banner"=>null),  
                          ),
      
      "sitemap"=>array(
                   "title"=>"Sitemap",
                   "javascripts"=>array('jquery-1.11.1.min.js'=>null,
                                        'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                                        'jquery.custom.js'=>null,
                                     //   'jquery.custom.messages.js'=>array("type"=>"url"),
                                        'product.js'=>array("module"=>"products"),                                     
                                       ),                  
                   "stylesheets"=>array("main.css"=>null,
                                        "themes/base/jquery.ui.all.css"=>null
                                       ),
                    'widgets'=>array("banner"=>null),  
                    'layout'=>array(
                                        "template"=>"/sitemap.xml",
                                        ),
                    'stylesheets'=>array("main.css"=>null,
                                          "themes/base/jquery.ui.all.css"=>null,
                                        "ui.datepicker.css"=>null,                                               
                                    ),                                               
     ),
     
    
); 
