<?php


class customers_contracts_ajaxGlobAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
//        foreach (moduleManagerUtilsAdmin::getAllModules() as $name=>$module){
//            $path=$_SERVER['DOCUMENT_ROOT']."/modules/".$name."/admin/config/";
//            $source=glob($path."menu.php");
//            $destination=mfConfig::get("mf_site_app_cache_dir")."/menu/".$name.'/';
//            mkdir($destination,0700,TRUE);
//            fopen($destination.'/menu.php','w');
//            if( !copy($source[0], $destination.'/menu.php') ) {  
//                echo "File can't be copied! \n";  
//            }  
//            else {  
//                echo "File has been copied! \n";  
//            }
//        }
        /*
         * ------------------- the copie menu ------------------*
         */
//        $dst=mfConfig::get("mf_site_app_cache_dir")."/menu/";/*__DIR__."/../data/menu/modules";*/
//         $dir= realpath(__DIR__."/../../../");
//         foreach (glob($dir."/*/admin/config/menu.php") as $menu)
//         {
//             $tmp=explode("/",$menu);
//             $module=$tmp[1];
//             $menu=new File($menu);
//             //$menu->copy($dst."/".$module."/");
//             if( !$menu->copy($dst."/".$module."/") ) {  
//                echo "File can't be copied! \n";  
//            }  
//            else {  
//               echo "File has been copied! \n";  
//            }
//         }
//         
//        /*
//         * ------------------- the copie tabs ------------------*
//         */
//        $dst=mfConfig::get("mf_site_app_cache_dir")."/tabs/";/*__DIR__."/../data/menu/modules";*/
//         $dir= realpath(__DIR__."/../../../");
//         foreach (glob($dir."/*/admin/config/tabs.php") as $menu)
//         {
//             $tmp=explode("/",$menu);
//             $module=$tmp[1];
//             $menu=new File($menu);
//             //$menu->copy($dst."/".$module."/");
//             if( !$menu->copy($dst."/".$module."/") ) {  
//                echo "File can't be copied! \n";  
//            }  
//            else {  
//               echo "File has been copied! \n";  
//            }
//         }
        /*
        * ------------------- the restore ------------------*
        */  
        
//        $src=mfConfig::get("mf_site_app_cache_dir")."/menu";        
//        $dst= realpath(__DIR__."/../../../");
//        foreach (glob($src."/*/menu.php") as $menu)
//        {
//            $tmp=explode("/",$menu);
//            $module=$tmp[2];
//            $menu=new File($menu);
//            if( !$menu->copy($dst."/".$module."/admin/config/") ) {  
//               echo "File can't be restored! \n";  
//           }  
//           else {  
//              echo "File has been restored! \n";  
//           }
//        }
     
        /*
        * ------------------- the merge ------------------*
        */  
        $src=mfConfig::get("mf_site_app_cache_dir")."/menu";
        
        foreach (glob($src."/*/menu.php") as $menu){
            $tmp=explode("/",$menu);
            $module=$tmp[2];
            $content1 = include (realpath(__DIR__."/../../../".$module.'/admin/config/menu.php'));
            $content2 = include ($menu);
            $merge= array_replace($content1,$content2);
//            file_put_contents(__DIR__."/../../../".$module.'/admin/config/menu2.php',"<?php return ". var_export($merge,TRUE));
            file_put_contents(mfConfig::get("mf_site_app_cache_dir")."/menu/".$module.'/menu2.php',"<?php return ". var_export($merge,TRUE));
                    //var_dump(var_export($merge,true)); 
            echo "Merge passed!";
            //die(__METHOD__);  
        }
    }

}

