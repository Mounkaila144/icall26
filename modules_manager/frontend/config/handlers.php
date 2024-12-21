<?php

return array(
     "config/i18n/*/routings.php"=>array("class"=>"mfRoutingI18nConfigHandler"),
     "module/*/config/module.php"=>array("class"=>"mfModuleConfigHandlerFrontend",
                                         "param"=>array("prefix"=>"mod_")
                                         ), 
);
