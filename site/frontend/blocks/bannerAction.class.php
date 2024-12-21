<?php

class site_bannerActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {     
       /*
        * foreach ($parameters as $_key=>$value)
       {
          if (in_array($_key,array('class','id','name','site','application','lang')))
              $$_key=$value;    
       }                        
       // If site variable passed  => banner shop_design or site ( by default)
       $banner=($site)?ShopsUtils::getBannerFromDefault($lang,$application,$site):$this->getContext()->getSite()->getBanner();    
       $shop_name=($site)?"":$this->getContext()->getSite()->getShop()->get('name');
       if ($banner)
       {    
           $class='banner';
           return sprintf('<a href="%s"><img alt="%s" src="%s" class="%s" %s %s/></a>',url("","url",$application,$site),
                                                                              $shop_name,
                                                                                url($banner,'picture',$application,$site),                                                                                           
                                                                                $class,($id?'id="'.$id.'"':""),
                                                                                ($name?'name="'.$name.'"':""));
       }     
       return "";
        */
    } 
    
    
}

