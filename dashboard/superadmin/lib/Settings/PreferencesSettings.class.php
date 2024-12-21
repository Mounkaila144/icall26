<?php

class PreferencesSettings extends mfSettingsBase {
    
     protected static $instance=null;
     
     function __construct($data=null)
     {
         parent::__construct($data);
     } 
      
     // Directory data
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSite()."/superadmin/view/pictures/";
    }
    
    public function getFavicon()
    {
      if (!$this->_favicon)      
         $this->_favicon=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('favicon'),
                 "url"=>"nocache/pictures/",
                 "parameters"=>array("urlType"=>"web")   
             ));
      return $this->_favicon;     
    }
    
    public function getFaviconIco()
    {
      if (!$this->_faviconIco)      
         $this->_faviconIco=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('favicon_ico'),                 
                 "url"=>"nocache/pictures/",
                 "parameters"=>array("urlType"=>"web")                   
             ));
      return $this->_faviconIco;     
    }
    
    public function deleteFavicon()
    {
        $this->getFavicon()->remove(); 
        $this->set('favicon','');
        $this->save();
    }
    
    public function deleteFaviconIco()
    {
        $this->getFaviconIco()->remove(); 
        $this->set('favicon_ico','');
        $this->save();
    }
    
    public function getBanner()
    {
      if (!$this->_banner)      
         $this->_banner=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('banner'),
                 "url"=>"nocache/pictures/",
                 "parameters"=>array("urlType"=>"web")   
             ));
      return $this->_banner;     
    }
    
     public function deleteBanner()
    {
        $this->getBanner()->remove(); 
        $this->set('banner','');
        $this->save();
    }
}
