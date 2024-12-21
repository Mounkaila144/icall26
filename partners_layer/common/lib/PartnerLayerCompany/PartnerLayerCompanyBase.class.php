<?php

class PartnerLayerCompanyBase extends mfObject2{
    
    protected static $fields=array('name','ape','siret','tva','logo','lat','lng','rge_start_at','rge_end_at',
                                   'coordinates','email','web','mobile','phone','comments',
                                   'fax','address1','address2','postcode','city','rge',
                                   'country','state','is_active','status','is_default',
                                   'created_at','updated_at');
    const table="t_partner_layer_company"; 
     protected static $foreignKeys=array(); 
       protected static $fieldsNull=array('rge_start_at','rge_end_at',); // By default
         
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
           if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['siret']))
             return $this->loadbySiret((string)$parameters['siret']);          
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         return $this->loadByEmail((string)$parameters);
      }   
    }
    
    protected function loadBySiret($siret)
    {
         $this->set('siret',$siret);
         $db=mfSiteDatabase::getInstance()->setParameters(array($siret));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE siret='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
      $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
      $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s"); 
      $this->is_active=isset($this->is_active)?$this->is_active:'YES';
      $this->status=isset($this->status)?$this->status:'ACTIVE';
      $this->is_default=isset($this->is_default)?$this->is_default:'NO';
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
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array( 'name'=>$this->get('name'),
                                $this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
   
    
       
    function getContacts()
    {
        if ($this->isNotLoaded())
            return null;
        if ($this->contacts)
            return $this->contacts;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('company_id'=>$this->get('id')))
                ->setQuery("SELECT *  FROM ". PartnerLayerContact::getTable().                           
                           " WHERE company_id={company_id}".                           
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          if (!$db->getNumRows())
            return null;
        $this->contacts=new PartnerLayerContactCollection(null,$this->getSite());
        while ($item=$db->fetchObject('PartnerLayerContact'))
        {           
           $item->site=$this->getSite();
           $this->contacts[]=$item->loaded();
        }        
        return $this->contacts;
    }
    
    function hasContacts()
    {
        return $this->getContacts();
    }
    
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    

     public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/layers/company/".$this->get('id');
    }   
    
     function hasLogo()
    {
        return (boolean)$this->get('logo');
    }
    /* =================================== P I C T U R E =========================================== */
    
    public function getLogo()
    {
      if (!$this->get('_logo'))      
      {    
         $this->_logo=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('logo'),
                 "urlPath"=>url("/nocache/data/layers/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/layers/company/".$this->get('id')."/".$this->get('logo'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_logo;     
    }
    
    public function deleteLogo()
    {
        $this->getLogo()->remove(); 
        $this->set('logo','');
        $this->save();
    }       
    
    public function getNameForLogo()
    {
       return preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
    
    function toArrayForDocument()
    {
        $values=parent::toArray(array('siret','name','rge','email','mobile','phone','web','address1','address2','postcode','city','comments'));
        $values['address']=$this->get('address1')." ".$this->get('address2')." ".$this->get('postcode')." ".$this->get('city');
        if ($this->hasLogo())
            $values['logo']=array('url'=>$this->getLogo()->getUrl());
        $values['siret']=new mfString($this->get('siret'));        
        if ($this->getFirstContact())
        {    
            $values['contacts'][0]=$this->getFirstContact()->toArrayForDocument();
        }      
        if ($this->hasRgeStartAt())
            $values['rge_start_at']=$this->getRgeStartAt ()->getExport();
          if ($this->hasRgeEndAt())
            $values['rge_end_at']=$this->getRgeEndAt ()->getExport();
        return $values;
    }
    
    function toArrayForVariables()
    {       
        $values=array();
        foreach (parent::toArray(array('siret','name','rge','email','mobile','phone','web','address1','address2','postcode','city','comments')) as $key=>$value)        
           $values['{$partner.layer.'.$key.'}']=$value;                
        $values['{$partner.layer.address}']=$this->get('address1')." ".$this->get('address2')." ".$this->get('postcode')." ".$this->get('city');
        $values['hr']="_____________________________________________________________________________________________________________________________";
        $values['{$partner.layer.siret}']=$this->get('siret');                
        if ($this->getFirstContact())       
        {    
            foreach ($this->getFirstContact()->toArrayForDocument() as $key=>$value)
                $values['{$partner.layer.contact.'.$key."}"]=$value;        
        }
         if ($this->hasRgeStartAt())
         {    
            foreach ($this->getRgeStartAt ()->getExport() as $key=>$value) 
                 $values['{$partner.layer.rge_start_at.'.$key."}"]=$value;
         }
          if ($this->hasRgeEndAt())
          {     
             foreach ($this->getRgeEndAt ()->getExport() as $key=>$value) 
                $values['{$partner.layer.rge_end_at.'.$key."}"]=$value;
          }
         return $values;       
    }
    
    
   static function getLayersForSelect($site=null)
    {
     
       static $list=null;
       if ($list) return $list;           
       $cache= new mfCacheFile('layers.select','admin',$site);
        if ($cache->isCached())       
            return $list=unserialize($cache->read());       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE is_active='YES'".
                           " ORDER BY comments ASC;")               
                ->makeSiteSqlQuery($site); 
      //  echo $db->getQuery();
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $list=array();
        while ($item=$db->fetchObject('PartnerLayerCompany'))
        {
           $list[$item->get('id')]=$item;
        } 
        $cache->register(serialize($list));
        return $list;
    }  
    
    static function getLayersByNameForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE is_active='YES'".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return array();
        $list=array();
        while ($item=$db->fetchObject('PartnerLayerCompany'))
        {
           $list[$item->get('name')]=strtoupper($item->get('name'));
        }     
        return $list;
    }  
    
     function toArrayForSelect()
    {
        return new mfArray(array(
            'siret'=>$this->get('siret'),
            'rge'=>$this->get('rge'),
            'name'=>strtoupper($this->get('name'))
        ));        
    }
    
    static function getLayersWithContacts($site=null)
    {
        $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('PartnerLayerCompany','PartnerLayerContact'))
                ->setQuery("SELECT {fields} FROM ".self::getTable().
                           " INNER JOIN ".PartnerLayerContact::getInnerForJoin('company_id').
                           " WHERE ".PartnerLayerCompany::getTableField('is_active')."='YES'".
                           " ORDER BY ".PartnerLayerCompany::getTableField('name')." ASC;")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;        
        while ($items=$db->fetchObjects())
        {
           $item=$items->getPartnerLayerContact();
           $item->set('company_id',$items->getPartnerLayerCompany());
           $list[$item->get('id')]=$item;
        }     
        return $list;
    }  
    
    
      protected function updateIsDefault()
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('id'=>$this->get('id')))
                ->setQuery("UPDATE ". self::getTable().
                           " SET is_default='NO'".
                           " WHERE id!={id}".                           
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
        return $this;
    }    
    
    function isDefault()
    {
        return $this->get('is_default')=='YES';
    }
    
    function save()
    {
        if (($this->hasPropertyChanged('is_default') && $this->isDefault()) || $this->isNotLoaded())
        {
            parent::save();
            $this->updateIsDefault();
        }           
        mfCacheFile::removeCache('layers','admin',$this->getSite());         
        return parent::save();
    }
    
      function getFirstContact()
    {
         if ($this->isNotLoaded())
            return null;
        if ($this->first_contact)
            return $this->first_contact;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('company_id'=>$this->get('id')))
                ->setQuery("SELECT * FROM ". PartnerLayerContact::getTable().                           
                           " WHERE company_id={company_id}". 
                           " ORDER BY id ASC ".
                           " LIMIT 0,1".
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          if (!$db->getNumRows())
            return null;       
        $this->first_contact=$db->fetchObject('PartnerLayerContact')->loaded()->setSite($this->getSite());       
        return $this->first_contact;
    }
    
    function toArrayForTransfer()
     {
         $values=array();         
         foreach (array('name','ape','siret','tva','logo','coordinates','email','web','mobile','phone',
                        'fax','address1','address2','postcode','city','country','state',) as $field)
         {
             $values[$field]=$this->get($field);
         }                  
         return $values;
     }
     
     
     function calculateCoordinates()
    {                         
        $service = new ServiceMap(null,$this->getSite());
        if (!$coordinates=$service->getEngine()->getCoordinatesFromAddress($this->get('postcode')." ".format_country($this->get('country')?$this->get('country'):"FR")))
        {
            $service->getAddress()->record($service->getEngine());
            return false;  
        }      

        $this->set('coordinates',$coordinates);                     
        $tmp=explode("|",$this->get('coordinates'));

        $this->set('lat',$tmp[1]);
        $this->set('lng',$tmp[0]);      
        return true;     
    }         
     
     function hasCoordinates()
     {
         return (boolean)$this->get('coordinates');
     }         
     
     
     function getCoordinates()
     {
         return new GPSCoordinate($this->get('lat'),$this->get('lng'));
     }
    
    function getLng()
    {      
        return $this->lng;
    }
    
    function getLat()
    {        
        return $this->lat;
    }
    
    function __toString() {
        return strtoupper($this->get('name')); 
    }
   
    function hasRgeStartAt()
   {
       return (boolean)$this->get('rge_start_at');
   }
   
   function hasRgeEndAt()
   {
       return (boolean)$this->get('rge_end_at');
   }
   
   function getRgeStartAt()
   {
       return new DateFormatter($this->get('rge_start_at'));
   }
   
    function getRgeEndAt()
   {
       return new DateFormatter($this->get('rge_end_at'));
   }

     function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('layers','admin',$this->getSite());         
         return $this;
     }
}
