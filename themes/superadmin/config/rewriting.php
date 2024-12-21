<?php
//  URL /application/web/ => URL pattern /
return array(
             
       "theme_preview_picture"=>array("pattern"=>"#^/themes/(admin|frontend|superadmin)/([^/]*)/preview.(jpg|gif|png)$#",
                                      "file"=>"/sites/themes/\\1/\\2/config/preview.\\3"
                                 )
);

