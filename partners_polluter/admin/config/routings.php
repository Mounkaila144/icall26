<?php

return array(
    
     "partners_polluter"=>array("pattern"=>'/partners/polluter/admin/{action}',"module"=>"partners_polluter","action"=>"{action}","requirements"=>array("action"=>".*")),
    
    "partners_polluter_ajax"=>array("pattern"=>'/module/partners/polluter/admin/{action}',"module"=>"partners_polluter","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

