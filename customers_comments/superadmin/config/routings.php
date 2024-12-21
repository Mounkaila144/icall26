<?php

return array(
    "customers_comments"=>array("pattern"=>'/customers/comments/admin/{action}',"module"=>"customers_comments","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_comments_ajax"=>array("pattern"=>'/module/site/customers/comments/admin/{action}',"module"=>"customers_comments","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

