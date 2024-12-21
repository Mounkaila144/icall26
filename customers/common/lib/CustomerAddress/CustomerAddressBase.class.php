<?php

class CustomerAddressBase extends mfObject2 {
     
    protected static $fields=array('customer_id','address1','address2','postcode','city','country','state','lat','lng','signature',
                                    'coordinates','status','created_at','updated_at');
    const table="t_customers_address"; 
    protected static $foreignKeys=array('customer_id'=>'Customer'); // By default
    protected static $fieldsNull=array('lat','lng'); // By default

    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         else
            return $this->loadBySignature((string)$parameters);  
      }   
    }
    
    
     protected function loadBySignature($signature)
    {      
         $this->set('signature',$signature);
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('signature'=>$signature))
            ->setQuery("SELECT * FROM ".static::getTable().
                       " WHERE signature='{signature}' AND signature!='' LIMIT 0,1;")
            ->makeSiteSqlQuery($this->site);                              
        return $this->rowtoObject($db); 
    }  
  /*  protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSqlSiteQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");   
       $this->country=isset($this->country)?$this->country:'FR';   
       $this->status=isset($this->status)?$this->status:"ACTIVE";
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {
    /*  
       $db->setParameters($parameters)
          ->setQuery("")
          ->makeSiteSqlQuery($this->site);   */  
    }
    
      protected function getAddressEscape()
    {
        return strtoupper(str_replace(array(","," "),"", $this->getFullAddress().$this->get('country').$this->get('state')));
    }
    
    function getFullAddressEscape()
    {
        return new mfStringJS($this->getFullAddress());
    }
    
    function getAddress1()
    {
        return new mfString($this->get('address1'));
    }
    
    function getAddress2()
    {
        return new mfString($this->get('address2'));
    }
    
    function getSignature()
    {
        return sha1($this->getAddressEscape()); 
    }
    
    function setSignature()
    {     
        $this->set('signature',$this->getSignature());      
        return $this;
    }       
    
   /* function getFullAddressForSignature()
    {
        $address="";
        foreach (array('address1','address2','postcode','city') as $field)
                $address.=$this->get($field)." ";
        return $address;
    } */
    
    function getFullAddressForCalculation()
    {
        $address="";
        foreach (array('postcode','city') as $field)
                $address.=$this->get($field)." ";
        return $address;
    }
           
    function getFullAddress()
    {
        $address="";
        foreach (array('address1','address2','postcode','city') as $field)
                $address.=$this->get($field)." ";
        return $address;
    }       
     
    function calculateCoordinates($force=false)
    {                  
        $address=new CustomerAddress($this->getSignature(),$this->getSite());         
        if ($address->isLoaded() && $address->get('id')!=$this->get('id'))
        {            
            $this->set('coordinates',$address->get('coordinates'));    
            $this->set('lat',$address->get('lat'));    
            $this->set('lng',$address->get('lng'));    
            return true;
        }         
        if ($address->get('id')==$this->get('id') && $force==false && $this->hasCoordinates())
        {           
            return true;
        }    
        $service = new ServiceMap(null,$this->getSite());
        if (!$coordinates=$service->getEngine()->getCoordinatesFromAddress($this->get('postcode')." ".format_country($this->get('country')?$this->get('country'):"FR")))
        {
            $service->getAddress()->record($service->getEngine());
            return false;  
        }      

        $this->set('coordinates',$coordinates);                
        $this->setSignature();
        $tmp=explode("|",$this->get('coordinates'));

        $this->set('lat',$tmp[1]);
        $this->set('lng',$tmp[0]);

        $service->getAddress()->record($service->getEngine());    
        return true;
        
      /*  $googlemap_api=new GoogleMapApi(null,$this->getSite());              
        if (!$coordinates=$googlemap_api->getCoordinatesFromAddress($this->get('postcode')." ".format_country($this->get('country')?$this->get('country'):"FR")))
        {                                 
            $log=new GoogleMapAddress(null,$this->getSite());
            $log->record($googlemap_api);           
          /*  if (!$coordinates=$googlemap_api->getCoordinatesFromAddress($this->get('postcode')." ".format_country($this->get('country')?$this->get('country'):"FR")))  
            {                        
                $log=new GoogleMapAddress(null,$this->getSite());
                $log->record($googlemap_api);
                return false;      
            } */        
   /*         return false;  
        }                   
        $this->set('coordinates',$coordinates);                
        $this->setSignature();
        $tmp=explode("|",$this->get('coordinates'));
        $this->set('lat',$tmp[1]);
        $this->set('lng',$tmp[0]);
        $log=new GoogleMapAddress(null,$this->getSite());
        $log->record($googlemap_api);
        SystemDebug::getInstance()->trace(date("Y-m-d H:i:s")."[".$this->getSite()->getHost()."] Log:".$log->get('id')." [".$this->get('signature')."] [".$this->getFullAddress()."]");
        return true;*/
    }
    
     function _getCoordinates()
     {
        if (!$this->latitude && !$this->longitude)
        {               
            $tmp=explode("|",$this->get('coordinates'));
            $this->latitude=$tmp[0];
            $this->longitude=$tmp[1];     
        }
        return $this;
     }  
     
     function hasCoordinates()
     {
         return (boolean)$this->get('coordinates');
     }
     
    function getCoordinates($reverse=false)
    {
        $this->_getCoordinates();
        if ($reverse)
            return $this->longitude." , ".$this->latitude;
        return $this->latitude." , ".$this->longitude;
    }   
    
    function getLongitude()
    {
        $this->_getCoordinates();
        return $this->longitude;
    }
    
    function getLatitude()
    {
        $this->_getCoordinates();
        return $this->latitude;
    }
    
    function getPostcodeRoot($start=0,$stop=2)
    {
        return substr($this->get('postcode'),$start,$stop);
    }
    
    function getDept()
    {     
        return sprintf('%02d',substr($this->get('postcode'),-5,-3));
    }
    
    function toArray($fields = null) {
        $values=parent::toArray($fields);
        $values['full']=$this->getFullAddress();       
        return $values;
    }
    
    
     function toArrayForPdf() {
        $values=array();
        foreach (parent::toArray() as $name=>$value)
          $values[$name]= mb_strtoupper($value);
        $values['full']=mb_strtoupper($this->getFullAddress());
        $values['postcode']=new mfString($this->get('postcode'));
        return $values;
    }
        
    
    function getCustomer()
    {
        if ($this->_customer_id===null)
        {
          $this->_customer_id=new Customer($this->get('customer_id'),$this->getSite());  
        }   
        return $this->_customer_id;
    }
    
    function toArrayForTransfer()
     {
         return parent::toArray(array('address1','address2','postcode','city','country','lat','lng','signature','coordinates'));
     }
     
     function getGPSCoordinates()
     {
         return $this->gps=$this->gps===null?new GPSCoordinate($this->getLatitude(),$this->getLongitude()):$this->gps;
         
     }
     
     
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new CustomerAddressFormatter($this);
        }   
        return $this->formatter;
    }
}
