<?php
// key = [action][view]
return array(
    
    "_javascripts"=>array(
        "plugins"=>array('blocks'=>array('JqueryScriptsReady'=>null),  
                         "widgets"=>array("javascripts"=>null),  
                        ),
        "javascripts"=>array(
              "bootstraps/default/hover-menu/bootstrap-hover-dropdown.js"=>array(),
              "bootstraps/default/bootstrap.min.js"=>array(),            
        ),   
   ),
    
     "_styles"=>array(
        "plugins"=>array(//'blocks'=>array('JqueryScriptsReady'=>null),  
                        "widgets"=>array("stylesheets"=>null),  
                        ),
      /*  "javascripts"=>array(
              "bootstrap.min"=>array("module"=>"theme_responsive","application"=>"frontend"),            
        ),*/
        "stylesheets"=>array(          
             "bootstraps/default/bootstrap.min.css"=>array(),
             "bootstraps/default/bootstrap-theme.min.css"=>array(),
             "bootstraps/default/responsive.min.css"=>array(),
          ),
   ),
); 
