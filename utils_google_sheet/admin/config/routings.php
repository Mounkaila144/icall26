<?php

return array(
    "utils_google_sheet"=>array("pattern"=>'/utils/google/sheet/admin/{action}',"module"=>"utils_google_sheet","action"=>"{action}","requirements"=>array("action"=>".*")),
    "utils_google_sheet_ajax"=>array("pattern"=>'/module/utils/google/sheet/admin/{action}',"module"=>"utils_google_sheet","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    "utils_google_sheet_callback" => array("pattern" => '/utils/google/sheet/callback',
        "module" => "utils_google_sheet",
        "action" => "callback",
    ),
);
