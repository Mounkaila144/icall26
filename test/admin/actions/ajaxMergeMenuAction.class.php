<?php


class test_ajaxMergeMenuAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
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
            file_put_contents(__DIR__."/../../../".$module.'/admin/config/menu2.php',"<?php return ". var_export($merge,TRUE));
                    //var_dump(var_export($merge,true)); 
            die(__METHOD__);  
        }
        
        }

}
