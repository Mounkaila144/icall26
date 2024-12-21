<?php

class CustomerContractExportKMLCollection {
    
    protected $collection=null,$filename=null;
    
    function __construct($collection,$site=null) 
    {
        $this->collection=$collection;    
        $this->site=$site;
        $this->filename=self::getDirectory($this->site)."/".$this->getName();
       // if (($this->file=fopen($filename, "w"))===false)
       //    return;         
    }     
    
    function getSite()
    {
        return $this->site;
    }
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/contracts"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/contracts";        
    }
    
    function getFilename()
    {        
        return $this->filename;
    }
    
     protected function calculateCoordinates()
     {
          $address_collection=new CustomerAddressCollection(null,$this->getSite());   
          $list=new mfArray();
          foreach ($this->collection as $dept=>$dates)
          {              
                foreach ($dates as $contracts)
                {
                    foreach ($contracts as $contract)
                    {                      
                        if ($contract->getCustomer()->getAddress()->hasCoordinates())                            
                            continue;                                       
                        $list[]=$contract->getCustomer()->getAddress();
                    }    
                }    
          }                           
          foreach ($list as $address)
          {                              
             if (isset($address_collection[$address->get('id')]))
                 continue;     
             $address_collection[$address->get('id')]=$address;
          }             
          $address_collection->loaded(); 
          foreach ($list as $address)
          {                              
               $address->calculateCoordinates();
          }
          $address_collection->save();         
     }
    
    function build()
    {                                            
       $this->calculateCoordinates();
       $document=new GoogleKmlDocument(__("customers")."-".date("d-m-Y")."-".__("contracts").".kmz");      
       foreach ($this->collection as $dept=>$dates)
       {       
            $dept=new GoogleKmlFolder("DPT ".$dept);            
            foreach ($dates as $date=>$contracts)
            {                   
                if ($this->getOptions() && ($this->getOptions()->isOpcRangeMode() || $this->getOptions()->isSavAtMode()))
                {                    
                  $folder=new GoogleKmlFolder($date);    
                }   
                else
                {    
                    $day=new Day($date);                
                    $folder=new GoogleKmlFolder(__($day->getDayName())." ".$day->getDate("d/m/Y"));    
                }                
                if ($this->getOptions() && $this->getOptions()->isSavAtMode())
                {
                    foreach ($contracts as $contract)
                    {                                                               
                       $folder->addItem(new GoogleKmlPlacemark($contract->getFormatter()->getSavAt()->getDateTime()->getTime()->render("{hour}:{minute}H")." ".strtoupper((string)$contract->getCustomer()),$contract->getCustomer()->getAddress()->getCoordinates()));
                    }                                        
                }   
                elseif ($this->getOptions() && $this->getOptions()->isSavAtRangeMode())
                {
                    foreach ($contracts as $contract)
                    {                                                               
                       $folder->addItem(new GoogleKmlPlacemark($date." - ". strtoupper((string)$contract->getCustomer()),$contract->getCustomer()->getAddress()->getCoordinates()));
                    }                                        
                }
                elseif ($this->getOptions() && $this->getOptions()->isOpcAtMode())
                {
                    foreach ($contracts as $contract)
                    {                                                               
                       $folder->addItem(new GoogleKmlPlacemark($contract->getFormatter()->getOpcAt()->getDateTime()->getTime()->render("{hour}:{minute}H")." ".strtoupper((string)$contract->getCustomer()),$contract->getCustomer()->getAddress()->getCoordinates()));
                    }                                        
                }   
                elseif ($this->getOptions() && $this->getOptions()->isOpcRangeMode())
                {
                    foreach ($contracts as $contract)
                    { 
                       $placemark=new GoogleKmlPlacemark($date." - ". strtoupper((string)$contract->getCustomer()),$contract->getCustomer()->getAddress()->getCoordinates());
                       mfContext::getInstance()->getEventManager()->notify(new mfEvent($placemark, 'contract.filter.kml.placemark',array('contract'=>$contract))); 
                       $folder->addItem($placemark);                        
                    }                                        
                } 
                else
                {                        
                    foreach ($contracts as $contract)
                    {                     
                        $folder->addItem(new GoogleKmlPlacemark($contract->getTime("h:i")."H ".strtoupper((string)$contract->getCustomer()),$contract->getCustomer()->getAddress()->getCoordinates()));
                    }
                }                
                $dept->addItem($folder);
            }            
            $document->addItem($dept);
       }                  
       mfFileSystem::mkdirs(self::getDirectory($this->site));
       file_put_contents($this->getFilename(), $document->output());      
    }            
    
    function getName()
    {
         return __("customers")."-".__("contracts")."-".date("Y-m-d")."-".md5(session_id()).".kml";
    }
        
}