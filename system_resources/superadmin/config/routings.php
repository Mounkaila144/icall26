<?php

return array(
    
    "system_resources"=>array("pattern"=>'/system/resources/admin/{action}',"module"=>"system_resources","action"=>"{action}","requirements"=>array("action"=>".*")),
    
    "system_resources_ajax"=>array("pattern"=>'/module/system/resources/admin/{action}',"module"=>"system_resources","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

