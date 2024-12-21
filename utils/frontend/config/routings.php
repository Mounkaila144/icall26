<?php

return array(
     "utils_city"=>array("pattern"=>'/module/utils/city',"module"=>"utils","action"=>"ajaxCity"),
     "utils_javascripts_culture"=>array("pattern"=>'/js/{file}_{culture}.js',"module"=>"utils","action"=>"getJavascriptController","requirements"=>array("file"=>".*","culture"=>".*"),"parameters"=>array("file"=>"{file}","culture"=>"{culture}")),             
     "utils_javascripts"=>array("pattern"=>'/js/{file}.js',"module"=>"utils","action"=>"getJavascriptController","requirements"=>array("file"=>".*"),"parameters"=>array("file"=>"{file}")),                    
);
/*
 
return array(
             "utils_city"=>array("pattern"=>'#^/module/utils/city(.*)$#',"module"=>"utils","action"=>"ajaxCity"),             
             "utils_javascripts"=>array("pattern"=>'#^/js/(.*).js$#',"module"=>"utils","action"=>"getJavascriptController","parameters"=>array("file"=>"\\1")),             
             "utils_javascripts_culture"=>array("pattern"=>'#^/js/(.*)_(.*)?.js$#',"module"=>"utils","action"=>"getJavascriptController","parameters"=>array("file"=>"\\1","culture"=>"\\2")),             
  );
*/