<?php


return array('all'=>array('classView'=>'SmartyView',
                           'widgets'=>array('messages'=>null),                             
                          ),
            

     "List"=>array(                                   
                            'layout'=>array("template"=>"layout_dashboard.xml"),
                            'stylesheets'=>array("main.css"=>null,
                                                 "themes/base/jquery.ui.all.css"=>null,
                                                ),      
                            'widgets'=>array("banner"=>null),                             
                            'title'=>'Site | Admin',
                            'blocks'=>array('JqueryScriptsReady'=>null),     
                            'javascripts'=>array('jquery-1.11.1.min.js'=>null,
                                                 'jquery.custom.js'=>null,
                                                 'jquery.custom.messages.js'=>array("type"=>"url"),
                                                 'ui/jquery-ui-1.8.20.custom.min.js'=>null,
                             ),
                             'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                              ),                                                             
     ),
    
    'ajaxList'=>array(
                        'blocks'=>array('JqueryScriptsReady'=>null),                                                                
    ),
    
    'ajaxSaveTheme'=>array(
                        'template'=>'site_ajaxViewTheme.tpl',                                                                
    ),
    
); 
 
