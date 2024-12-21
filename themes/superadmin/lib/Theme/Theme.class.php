<?php


class Theme extends ThemeBase  {

   
   /* public function getPreview()
    {
      if (!$this->get('_preview'))      
         $this->_preview=new PictureObject2(array(
                 "path"=>$this->getDirectory()."/config",
                 "picture"=>$this->get('preview'),
                 "url"=>"/themes/".$this->get('application')."/".$this->get('name')."/",
                 "parameters"=>array("urlType"=>"web")
             ));
      return $this->_preview;     
    } */
    
}

class ThemeFrontend extends Theme {
   
    function __construct($parameters=null,$site=null) 
    {
        parent::__construct($parameters,'frontend',$site);
    }
}

