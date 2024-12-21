<?php

class CustomerMeetingExportKMLCollection {
    
    protected $collection=null,$filename=null;
    
    function __construct($collection,$site=null) 
    {
        $this->collection=$collection;    
        $this->site=$site;
        $this->filename=self::getDirectory($this->site)."/".$this->getName();
       // if (($this->file=fopen($filename, "w"))===false)
       //    return;         
    }        
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/meetings"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/meetings";        
    }
    
    function getFilename()
    {        
        return $this->filename;
    }
    
    function build()
    {
       $document=new GoogleKmlDocument(__("customers")."-".date("d-m-Y")."-".__("meetings").".kmz");
       foreach ($this->collection as $dept=>$dates)
       {       
            $dept=new GoogleKmlFolder("DPT ".$dept);            
            foreach ($dates as $date=>$meetings)
            {               
                $day=new Day($date);                
                $date=new GoogleKmlFolder(__($day->getDayName())." ".$day->getDate("d/m/Y"));    
                foreach ($meetings as $meeting)
                {                     
                    $date->addItem(new GoogleKmlPlacemark($meeting->getTime("H:i")."H ".(string)$meeting->getCustomer(),$meeting->getCustomer()->getAddress()->getCoordinates()));
                }  
                $dept->addItem($date);
            }  
            $document->addItem($dept);
       }        
       mfFileSystem::mkdirs(self::getDirectory($this->site));
       file_put_contents($this->getFilename(), $document->output());      
    }            
    
    function getName()
    {
         return __("customers")."-".__("meetings")."-".date("Y-m-d")."-".md5(session_id()).".kml";
    }
        
}