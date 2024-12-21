<?php

class OpenstreetMapAddressBase extends mfObject2 {
    protected static $fields=array('address','postcode','city','country','lat','lng','signature','error', 'created_at','updated_at');
    const table="t_utils_openstreet_map_address";
    
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
                       " WHERE signature='{signature}' AND signature!='';")
            ->makeSqlQuery();;
        return $this->rowtoObject($db); 
    }  

    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSqlSiteQuery($this->site);
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");         
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
    
    
     protected function getAddressEscape()
    {
        return strtoupper(str_replace(array(","," "),"", $this->get('address')));
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
   
    function getCoordinates()
    {
        if ($this->coordinates===null)
        {
           $this->coordinates=new  CoordinateFormatter(new GPSCoordinate($this->get('lat'),$this->get('lng')));
        }   
        return $this->coordinates;
    }
    
    
    function getCreatedAt()
    {
        return new DateFormatter($this->get('created_at'));
    }
    
    function hasError()
    {
        return (boolean)$this->get('error');
    }
    

    
    
    static function initializeSite($site=null)
    {
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("TRUNCATE ".OpenstreetMapAddress::getTable().";")               
                ->makeSiteSqlQuery($site);                     
    }
    public function calculateCoordinates($force = false)
    {
        $this->setSignature();
        $existingAddress = new self($this->get('signature'), $this->getSite());

        if ($existingAddress->isLoaded() && $existingAddress->get('id') != $this->get('id')) {
            $this->add(['postcode'=> $existingAddress->get('postcode'),'city'=> $existingAddress->get('city'),
                'country'=> $existingAddress->get('country'),'lat'=> $existingAddress->get('lat'),'lng'=> $existingAddress->get('lng')]);
            return true;
        }

        if (!$force && $this->hasCoordinates()) return true;

        $api = new UtilOpenStreetMapApi();
        if (!$api->getCoordinatesFromAddress($this->get('address'))) {
            $this->set('error', $api->getError());
            $this->save();
            return false;
        }

        $this->add(['lng' => $api->getLongitude(), 'lat' => $api->getLatitude(), 'postcode' => $api->getPostcode(),
            'city' => $api->getCity(), 'country' => $api->getCountryCode(), 'error' => null
        ]);
        $this->setSignature();
        return $this->save() && true;
    }
    /**
     * Vérifie si l'objet a des coordonnées valides.
     *
     * @return bool
     */
    protected function hasCoordinates()
    {
        return !empty($this->get('lat')) && !empty($this->get('lng'));
    }


}
