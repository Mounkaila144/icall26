<?php

return array(
     "themes_admin_list"=>array("pattern"=>'/themes/admin',"module"=>"themes","action"=>"List"),    
     "themes_admin_ajax"=>array("pattern"=>'/module/themes/admin/{action}',"module"=>"themes","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
      "themes_admin_preview"=>array("pattern"=>'/themes/preview/{theme}/{preview}',
                            "requirements"=>array("theme"=>".*","preview"=>"(.*)\.(jpg|gif|png)"),
                            "module"=>"themes",
                            "action"=>"previewFrontend",
                          //  "defaults"=>array("url"=>"index","page"=>""),
                            "parameters"=>array("theme"=>"{theme}","preview"=>"{preview}")),  
  );
