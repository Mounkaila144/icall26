<?php

return array(
    "index"=>array("pattern"=>'/{index}',"requirements"=>array("index"=>"(index.php|index.html|index.htm)?"),"module"=>"dashboard","action"=>"index"),
    "dashboard_ajax"=>array("pattern"=>'/module/dashboard/admin/{action}',"requirements"=>array("action"=>"(.*)"),"module"=>"dashboard","action"=>"ajax{action}"),
    
    "dashboard"=>array("pattern"=>'/dashboard/admin/{action}',"requirements"=>array("action"=>"(.*)"),"module"=>"dashboard","action"=>"{action}"),
);

/* 
return array(
    "root"=>array("pattern"=>"#^/(index.php|index.html|index.htm)?$#","module"=>"dashboard","action"=>"index"),
); */