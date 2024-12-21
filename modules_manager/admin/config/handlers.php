<?php

return array(
     "module/*/config/module.php"   =>  array("class"=>"mfModuleConfigHandlerAdmin",
                                            "param"=>array("prefix"=>"mod_",
                                                            "class"=>"ModuleConfigManager"
                                                    )
                                           ), 
     "config/menu.php"         =>  array("class"=>"mfMenuConfigHandler","param"=>array("class"=>"ModuleConfigManager")),  
);
