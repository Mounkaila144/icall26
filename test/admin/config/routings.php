<?php

return array(
    
    "test_ajax"=>array("pattern"=>'/module/site/test/admin/{action}',"module"=>"test","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    "test"=>array("pattern"=>'/module/site/test/admin/{action}',"module"=>"test","action"=>"{action}","requirements"=>array("action"=>".*")),
);

