<?php

return array(
    
  "languages_list"=>array("pattern"=>'/languages',"module"=>"site_languages","action"=>"List"),
  "languages_ajax"=>array("pattern"=>'/module/languages/{action}',"module"=>"site_languages","action"=>"ajax{action}","requirements"=>array("action"=>".*")),   
);

