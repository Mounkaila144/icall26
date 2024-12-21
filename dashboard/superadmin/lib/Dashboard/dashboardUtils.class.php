<?php


class dashboardUtils {
    
  /*  static function getFavicons()
    {
      $dir=mfContext::getInstance()->getSite()->getSiteDirectory("view/pictures");
       $favicons=array();
      foreach (array("/favicon.*","/ * /favicon.*") as $path)
          foreach (glob($dir."/favicon.*") as $favicon)
          {
             $favicons[]=new pictureObject(array(
               "path"=>$dir,
               "picture"=>str_replace($dir."/","", $favicon),
               "url"=>"nocache/pictures/",
               "parameters"=>array("urlType"=>"web")  
             ));
          }    
       return $favicons;
    } */
   /* 
    function getFavicons()
    {
        $settings= new PreferencesSettings(); 
        $favicons=array();
        if ($settings->get('favicon'))
            $favicons[]=$settings->getFavicon();
        if ($settings->get('favicon_ico'))
            $favicons[]=$settings->getFaviconIco();
        return $favicons;
    } */
}

