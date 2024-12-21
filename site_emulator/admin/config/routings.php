<?php

return array(
    
     "site_emulator_ajax"=>array("pattern"=>'/module/site/emulator/admin/{action}',"module"=>"site_emulator","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
     "site_emulator"=>array("pattern"=>'/site/emulator/admin/site/emulator/admin/{action}',"module"=>"site_emulator","action"=>"{action}","requirements"=>array("action"=>".*")),

    );

