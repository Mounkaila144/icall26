<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',
                           'stylesheets'=>array("main.css"=>null),
                          ),
    
                'error404'=>array('title'=>"Page not found"),
     
                'login'=>array(
                                  'javascripts'=>array('jquery-1.4.2.min.js'=>null), 
                                  'title'=>"Login", // %actionName%
                                  'metas'=>array(
                                                "description"=>"super web",
                                                "keywords"=>"key1,key2...",
                                           ),
                                  ),
            ); 
 
