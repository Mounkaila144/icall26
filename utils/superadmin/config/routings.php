<?php

return array(
    "utils_city"=>array("pattern"=>'/module/utils/city',"module"=>"utils","action"=>"ajaxCity"),
    "utils_javascripts_culture"=>array("pattern"=>'/js/{file}_{culture}.js',"module"=>"utils","action"=>"getJavascriptController","requirements"=>array("file"=>".*","culture"=>".*"),"parameters"=>array("file"=>"{file}","culture"=>"{culture}")),             
    "utils_javascripts"=>array("pattern"=>'/js/{file}.js',"module"=>"utils","action"=>"getJavascriptController","requirements"=>array("file"=>".*"),"parameters"=>array("file"=>"{file}")),                 
    "utils_ajax_textemaili18n"=>array("pattern"=>'/module/utils/TextEmailI18n/admin/{action}',
                            "requirements"=>array("action"=>"View|New|List|Save"),
                            "module"=>"utils","action"=>"ajax{action}TextEmailI18n",
                            ),   
     "utils_ajax_textI18n"=>array("pattern"=>'/module/utils/TextI18n/admin/{class}/{action}',
                            "requirements"=>array("class"=>".*","action"=>".*"),
                            "module"=>"utils","action"=>"ajax{action}",
                            "parameters"=>array("class"=>"{class}")),  
);

