<?php

class test_restoreMenuAction extends cronAction {
    
    function execute()
    {                
        /*
        * ------------------- the restore ------------------*
        */      
        $src=mfConfig::get("mf_site_app_cache_dir")."/menu";        
        $dst= realpath(__DIR__."/../../../");
        foreach (glob($src."/*/menu.php") as $menu)
        {
            $tmp=explode("/",$menu);
            $module=$tmp[2];
            $menu=new File($menu);
            if( !$menu->copy($dst."/".$module."/admin/config/") ) {  
               echo "File can't be restored! \n";  
           }  
           else {  
              echo "File has been restored! \n";  
           }
        }        
    }
}
