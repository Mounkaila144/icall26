<?php


class SiteCompanyPictures extends Pictures {
     
     function __construct(SiteCompany $item) {
        parent::__construct($item);
    }
    
    function getCompany()
    {
        return $this->getItem();
    }
    
     function hasPicture()
    {
        return $this->getItem()->hasFile();
    }     
    /*
     
     */
    function getOriginal()
    {
        if ($this->original===null)
        {
            $this->original=new PictureObject3(array(
                 "path"=>$this->getCompany()->getDirectory(),
                 "picture"=>$this->getCompany()->get('picture'),
                 "urlPath"=>url($this->getCompany()->getPathForUrl(),'web',"frontend"),
                 "url"=>url($this->getCompany()->getPathForUrl()."/".$this->getCompany()->get('picture'),'web',"frontend",$this->getCompany()->getSite()),
            ));           
        }   
        return $this->original;
    } 
    
    function generate() {
        $this->generateMedium();
        $this->generateThumb();
        $this->generateSmall();
    }
    
    function generateMedium()
    {           
       $this->getOriginal()->resize($this->get('medium_width',640),$this->get('medium_height',480),"","","/picture/medium/");                  
       return $this;
    }
    
    function generateThumb()
    {             
       $this->getOriginal()->resize($this->get('thumb_width',320),$this->get('thumb_height',220),"","","/picture/thumb/");
       return $this;
    }
    
     function generateSmall()
    {             
       $this->getOriginal()->resize($this->get('small_width',160),$this->get('small_height',110),"","","/picture/small/");
       return $this;
    }
    
    function getDirectory()
    {        
       return  $this->getCompany()->getDirectory();
    }
    
    protected function getPicture($type="")
    {               
       return new PictureObject3(array(
                 "path"=>$this->getDirectory()."/".$type."/picture/",
                 "file"=>$this->getCompany()->get('picture'),
                 "urlPath"=>url($this->getCompany()->getPathForUrl()."/picture/".$type,'web'),
                 "url"=>url($this->getCompany()->getPathForUrl()."/picture/".$type."/".$this->getCompany()->get('picture'),'web',"frontend",$this->getCompany()->getSite())
        ));
    }

    
    
     function getURL()
    {
       return $this->getOriginal()->getUrl();
    }
    
       function getURLPath()
    {
       return $this->getOriginal()->getUrlPath();
    }
    
    function toArray($fields=array())
    {
        if (!$fields)        
            $fields=array('url','medium','small','thumb');        
        $values=array();
        foreach ($fields as $field)
        {    
            if ($field=='name')
                $values['name']=$this->getCompany()->get('picture');
            if ($field=='url')
                 $values['url']=$this->getOriginal()->getUrl();
            if ($field=='medium')
                $values['medium']['url']=$this->getMedium()->getUrl();
            if ($field=='small')
                $values['small']['url']=$this->getSmall()->getUrl();
            if ($field=='thumb')
                $values['thumb']['url']=$this->getThumb()->getUrl();    
        }
        return $values;
    }
    
    function getFile()
    {
        return $this->getOriginal()->getFile();
    }
}
