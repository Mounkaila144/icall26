<?php

class test_copyMenuAction extends cronAction {
    
    function execute()
    {                        
        /*
         * ------------------- the copie ------------------*
         */
        $dst=mfConfig::get("mf_site_app_cache_dir")."/menu/";/*__DIR__."/../data/menu/modules";*/
         $dir= realpath(__DIR__."/../../../");
         foreach (glob($dir."/*/admin/config/menu.php") as $menu)
         {
             $tmp=explode("/",$menu);
             $module=$tmp[1];
             $menu=new File($menu);
             if( !$menu->copy($dst."/".$module."/") ) {  
                echo "File can't be copied! \n";  
            }  
            else {  
               echo "File has been copied! \n";  
            }
         }
        
    }
}
