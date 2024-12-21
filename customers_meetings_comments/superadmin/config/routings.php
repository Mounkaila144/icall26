<?php

return array(
    "customers_meetings_comments"=>array("pattern"=>'/customers/meetings/comments/admin/{action}',"module"=>"customers_meetings_comments","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_meetings_comments_ajax"=>array("pattern"=>'/module/site/customers/meetings/comments/admin/{action}',"module"=>"customers_meetings_comments","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

