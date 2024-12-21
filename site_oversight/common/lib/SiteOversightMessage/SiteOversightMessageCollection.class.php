<?php


 
class SiteOversightMessageCollection extends mfObjectCollection3 {
    
    protected $instance=null;
    
    static function getInstance()
    {
        if (self::$instance===null)
            self::$instance=new self();
        return self::$instance;
    }
    
     function setIsSent()
     {
         foreach ($this as $item)
             $item->set('is_sent','YES');
         $this->save();
         return $this;
     }
    
}

