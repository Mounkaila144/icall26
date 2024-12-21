<?php

 
abstract class Pictures   {
    
    protected $original=null,$thumb=null,$medium=null,$small=null,$item=null,
              $medium_width=640,$medium_height=480,
              $small_width=320,$small_height=240,
              $thumb_width=80,$thumb_height=60;
    
    abstract function hasPicture();    
    abstract protected function getPicture($type="");
    
    function __construct($item) {
        $this->item=$item;
    }
    
    function getItem()
    {
        return $this->item;
    }
    
    function getOriginal()
    {
        return $this->original= $this->original===null?$this->getPicture("original"):$this->original;
    } 
    
    function getMedium()
    {
        return $this->medium=$this->medium===null?$this->getPicture("medium"):$this->medium;
    }
    
     function getSmall()
    {
        return $this->small=$this->small===null?$this->getPicture("small"):$this->small;
    }
    
    
    function getThumb()
    {
        return $this->thumb=$this->thumb===null?$this->getPicture("thumb"):$this->thumb;
    } 
    
    
    function remove()
    {
        return $this->delete();
    }
    
    function delete()
    {
        $this->getThumb()->remove();
        $this->getOriginal()->remove();
        $this->getMedium()->remove();
        $this->getSmall()->remove();
        return $this;
    }
    
    function getUrl()
    {
        return $this->getOriginal()->getUrl();      
    }
    
    function generate()
    {       
        if ($this->getItem()->isNotLoaded())    
            return $this;              
        $this->getOriginal()->resize($this->get('medium_width',250),$this->get('medium_height',250),"","","/medium/");                  
        $this->getOriginal()->resize($this->get('thumb_width',80),$this->get('thumb_height',80),"","","/thumb/");
        $this->getOriginal()->resize($this->get('small_width',128),$this->get('small_height',128),"","","/small/");      
        return $this;
    }
    
    
    function get($name,$default=null)
    {
        return isset($this->$name) && $this->$name ?$this->$name:$default;
    }        
    
    function getPath()
    {
        return $this->getOriginal()->getPath();
    }
     
    function removeAll()
    {
        mfFileSystem::net_rmdir($this->getItem()->getDirectory());
        return $this;
    }
    
    function getMethodByType($type=null)
    {
       return $type===null?"getOriginal":"get".ucfirst($type); 
    }        
    
    function getPictureByType($type=null)
    {
        if ($type===null || !in_array($type,array('small','medium','original','thumb')))
            return $this->getOriginal();                      
         return $this->{$this->getMethodByType($type)}();
    }
}
