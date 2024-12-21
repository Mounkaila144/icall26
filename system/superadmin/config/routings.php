<?php

return array(
    
     "system_ajax"=>array("pattern"=>'/module/system/admin/{action}',"module"=>"system","action"=>"ajax{action}","requirements"=>array("action"=>".*")),

     "system_test"=>array("pattern"=>'/system/admin/test',"module"=>"system","action"=>"test"),

);

