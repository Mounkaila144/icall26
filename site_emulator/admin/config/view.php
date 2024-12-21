<?php
// key = [action][view]
 return array(
     

        'all'=>array('classView'=>'SmartyView',
                    'widgets'=>array('messages'=>array()),
                          ),
        "AjaxEmulator"=>array(
          
            "plugins"=>array(
                    "widgets"=>array("javascripts"=>'',"stylesheets"=>''),
                    'blocks'=>array('JqueryScriptsReady'=>null),
            ),
          
             "javascripts"=>array(
                 "jquery-1.11.1.min.js"=>array("module"=>"site_emulator"),
             ),
           
             "stylesheets"=>array(

             ),
            ),
            
     
); 
 
