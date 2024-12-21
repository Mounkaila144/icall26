<?php

class CustomerAddressCollection extends mfObjectCollection2 {
    
    function __construct($data=null,$site=null) {
        parent::__construct($data, null, $site);
    }
    
    
     protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site); 
    }
    
    
    function generateCoordinates()
    {
        $this->number_of_errors=0;
        $this->number_of_valid=0;
      //  var_dump($this);
        
    /*    $collection=new GoogleMapAddressCollection(null,$this->getSite());
        foreach ($this->collection as $item)
        {
            $log=new GoogleMapAddress(null,$this->getSite());
            $api=new GoogleMapApi(null,$this->getSite());              
            if (!$coordinates=$api->getCoordinatesFromAddress($item->get('postcode')." ".format_country($item->get('country')?$item->get('country'):"FR")))
            {                                
                $collection[]=$log->setFromApi($api);
                if (!$coordinates=$api->getCoordinatesFromAddress($item->get('postcode')." ".format_country($item->get('country')?$item->get('country'):"FR")))  
                {                                                   
                    $collection[]=$log->setFromApi($api);
                    $this->number_of_errors++;
                    continue;
                }   
            }    
            $item->set('coordinates',$coordinates);                
            $item->setSignature();            
            $item->set('lat',$api->getLatitude());
            $item->set('lng',$api->getLongitude());                        
            $collection[]=$log->setFromApi($api);
            $this->number_of_valid++;
        }    
        $collection->save();*/
        
        $service = new ServiceMap(null,$this->getSite());
        $collection=$service->getAddressCollection();
        foreach ($this->collection as $item)
        {             
            if (!$coordinates=$service->getEngine()->getCoordinatesFromAddress($item->get('postcode')." ".format_country($item->get('country')?$item->get('country'):"FR")))
            {                  
                $collection[]=$service->getAddress()->setFromApi($service->getEngine());
                if (!$coordinates=$service->getEngine()->getCoordinatesFromAddress($item->get('postcode')." ".format_country($item->get('country')?$item->get('country'):"FR")))  
                {                                                   
                    $collection[]=$service->getAddress()->setFromApi($service->getEngine());
                    $this->number_of_errors++;
                    continue;
                }   
            }    
            $item->set('coordinates',$coordinates);                
            $item->setSignature();            
            $item->set('lat',$service->getEngine()->getLatitude());
            $item->set('lng',$service->getEngine()->getLongitude());                        
            $collection[]=$service->getAddress()->setFromApi($service->getEngine());
            $this->number_of_valid++;
        }    
        $collection->save();        
        
        $this->save();
    }
    
     function getNumberOfErrors()
    {
        return $this->number_of_errors;
    }
    
    function getNumberOfValidAddress()
    {       
        return $this->number_of_valid;
    }
    
    
}

