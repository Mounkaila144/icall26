<?php

return array(
    "utils_javascripts_culture"=>array("pattern"=>'/js/{file}_{culture}.js',"module"=>"utils","action"=>"getJavascriptController","requirements"=>array("file"=>".*","culture"=>".*"),"parameters"=>array("file"=>"{file}","culture"=>"{culture}")),             
    "utils_javascripts"=>array("pattern"=>'/js/{file}.js',"module"=>"utils","action"=>"getJavascriptController","requirements"=>array("file"=>".*"),"parameters"=>array("file"=>"{file}")),                        
    "utils_city_ajax"=>array("pattern"=>'/module/utils/city/{action}',"module"=>"utils","action"=>"ajax{action}","requirements"=>array("action"=>".*")),                    
);

