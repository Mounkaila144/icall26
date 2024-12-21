<?php

return array(
    "customers_meetings_imports_google_sheet"=>array("pattern"=>'/customers/meetings/imports/google/sheet/admin/{action}',"module"=>"customers_meetings_imports_google_sheet","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_meetings_imports_google_sheet_ajax"=>array("pattern"=>'/module/customers/meetings/imports/google/sheet/admin/{action}',"module"=>"customers_meetings_imports_google_sheet","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);
