<?php

return array(
    "themes_list_theme"=>array("pattern"=>'/sites/themes',"module"=>"themes","action"=>"themesList"),
    "themes_export_theme"=>array("pattern"=>'/sites/themes/export',"module"=>"themes","action"=>"themeExport"),
    "themes_ajax_theme"=>array("pattern"=>'/module/themes/{action}',"module"=>"themes","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    "themes_ajax_themes"=>array("pattern"=>'/module/site/themes/admin/{action}',"module"=>"themes","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

