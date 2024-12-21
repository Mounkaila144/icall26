<?php

return array(
    "site_admin"=>array("pattern"=>'/site/admin{base}',"module"=>"site","action"=>"siteAdmin","requirements"=>array("base"=>"/?")),     
    "site_ajax"=>array("pattern"=>'/module/site/admin/{action}',"module"=>"site","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    "site"=>array("pattern"=>'/sites/admin/{action}',"module"=>"site","action"=>"{action}","requirements"=>array("action"=>".*")),
);

