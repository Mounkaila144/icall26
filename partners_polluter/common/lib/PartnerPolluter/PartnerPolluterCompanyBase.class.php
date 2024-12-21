<?php


class PartnerPolluterCompanyBase extends mfObject2{
    
    protected static $fields=array('name','ape','siret','tva','logo',
                                   'coordinates','email','web','mobile','phone',
                                   'fax','address1','address2','postcode','city',
                                   'country','state','is_active','status',
                                   'is_default','commercial','type',
                                   'comments','picture','username',
                                   'signature','footer','layer_id',
                                   'cumac_min','end_at','mode','prime_precision',
                                   'created_at','updated_at');
    const table="t_partner_polluter_company";  
        protected static $foreignKeys=array('layer_id'=>'PartnerLayer','end_at', 'cumac_min','end_at',); // By default
    
         
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {         
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);  
          if (isset($parameters['is_default']))
             return $this->loadDefault(); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         return $this->loadByName((string)$parameters);
      }   
    }
    
    protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array('name'=>$name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='{name}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadDefault()
    {         
         $db=mfSiteDatabase::getInstance()->setParameters(array());
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE is_default='YES';")
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
      $this->country=isset($this->country)?$this->country:'fr';
      $this->status=isset($this->status)?$this->status:'ACTIVE';
      $this->is_default=isset($this->is_default)?$this->is_default:'NO';
      $this->mode=isset($this->mode)?$this->mode:'contract';
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
      $key_condition=$this->getKey()?" AND ".self::getKeyName()."!='%s';":"";
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
                ->setQuery("SELECT *  FROM ". PartnerPolluterContact::getTable().                           
                           " WHERE company_id={company_id}".                           
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          if (!$db->getNumRows())
            return null;
        $this->contacts=new PartnerPolluterContactCollection(null,$this->getSite());
        while ($item=$db->fetchObject('PartnerPolluterContact'))
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
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/polluters/company/".$this->get('id');
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
                 "urlPath"=>url("/nocache/data/polluters/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/polluters/company/".$this->get('id')."/".$this->get('logo'),"web","frontend",$this->getSite())
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
    
    
    /* =================================== S I G N A T U R E =========================================== */
     function hasSignature()
    {
        return (boolean)$this->get('signature');
    }
    
    public function getSignature()
    {
      if (!$this->get('_signature'))      
      {    
         $this->_Signature=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('signature'),
                 "urlPath"=>url("/nocache/data/polluters/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/polluters/company/".$this->get('id')."/".$this->get('signature'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_Signature;     
    }
    
    public function deleteSignature()
    {
        $this->getSignature()->remove(); 
        $this->set('signature','');
        $this->save();
    }       
    
    public function getNameForSignature()
    {
       return "signature_".preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
     /* =================================== P I C T U R E =========================================== */
    
     function hasPicture()
    {
        return (boolean)$this->get('picture');
    }
       
    public function getPicture()
    {
      if (!$this->get('_picture'))      
      {    
         $this->_picture=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('picture'),
                 "urlPath"=>url("/nocache/data/polluters/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/polluters/company/".$this->get('id')."/".$this->get('picture'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_picture;     
    }
    
    public function deletePicture()
    {
        $this->getLogo()->remove(); 
        $this->set('picture','');
        $this->save();
    }       
    
    public function getNameForPicture()
    {
       return "picture_".preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
    
    function getNameAlphaNum($replace="_")
    {
        return preg_replace('/[^a-z0-9]/iu',$replace, $this->get('name'));
    }
    
    function toArrayForDocument()
    {
        $values=array();
        foreach (parent::toArray(array('name','commercial','email','phone','web','address1','address2','mobile','postcode','city')) as $idx=>$value)
            $values[$idx]= mb_strtoupper ($value);       
        $values['address']=mb_strtoupper ($this->get('address1')." ".$this->get('address2')." ".$this->get('postcode')." ".$this->get('city'));
        if ($this->hasLogo())
            $values['logo']=array('url'=>$this->getLogo()->getUrl());
        if ($this->hasSignature())
            $values['signature']=array('url'=>$this->getSignature()->getUrl());
        if ($this->hasPicture())
            $values['picture']=array('url'=>$this->getPicture()->getUrl());
        $values['siret']=new SiretFormatter(mb_strtoupper($this->get('siret')));        
        if ($this->getFirstContact())
        {    
            $values['contacts'][0]=$this->getFirstContact()->toArrayForDocument();
        }
        $values['comments']=$this->getCommentsForDocument();
        return $values;
    }
    
    function getCommentsForDocument()
    {
        $values=array();
        foreach (SiteCompanyUtils::getSiteCompany()->toArray() as $name=>$value)
        {
            if (is_string($value))
                $values['{$company.'.$name."}"]= mb_strtoupper($value);
        }     
        
        return strtr($this->comments,$values);
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
    
    function getFirstContact()
    {
         if ($this->isNotLoaded())
            return null;
        if ($this->first_contact)
            return $this->first_contact;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('company_id'=>$this->get('id')))
                ->setQuery("SELECT * FROM ". PartnerPolluterContact::getTable().                           
                           " WHERE company_id={company_id}". 
                           " ORDER BY id ASC ".
                           " LIMIT 0,1".
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          if (!$db->getNumRows())
            return null;       
        $this->first_contact=$db->fetchObject('PartnerPolluterContact')->loaded()->setSite($this->getSite());       
        return $this->first_contact;
    }
    
    static function getPollutersForSelect($site=null)
    {
       $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE is_active='YES' AND mode='contract'".
                           " ORDER BY is_active,name ASC;")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {
           $list[$item->get('id')]=$item;
        }     
        return $list;
    }   
    
      static function getPolluters2ForSelect($site=null)
    {
       $list=array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE is_active='YES'".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {
           $list[$item->get('id')]=(string)$item;
        }     
        return $list;
    } 
    
    static function getPollutersWithUsernameForSelect($site=null)
    {
        $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE is_active='YES'".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {
           $list[$item->get('id')]=(string)$item->getNameWithUserName();
        }     
        return $list;
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
        mfCacheFile::removeCache('polluters','admin',$this->getSite());   
        return parent::save();
    }
    
    static function getDefault($site=null)
    {
        return new self(array('is_default'=>'YES'),$site);
    }
    
     function toArrayForTransfer()
     {
         $values=array();         
         foreach (array('name','ape','siret','tva','coordinates','email','web','mobile','phone',
                        'fax','address1','address2','postcode','city','country','commercial',
                       ) as $field)
         {
             $values[$field]=$this->get($field);
         }                  
         return $values;
     }
     
     
     function toXML()
     {
        $values= parent::toArray(); 
        $values['comments']="<![CDATA[".$values['comments']."]]>";       
        if ($this->getFirstContact())
            $values['contacts']=$this->getFirstContact()->toArray();
        return $values;
     }
     
     function __toString() {
         return strtoupper($this->get('name'))." (".$this->get('id').")";
     }
     
     function getNameWithUserName(){
         return (string)$this.($this->get('username')?" - ".$this->get('username'):"");
     }
     
     function getTypeI18n()
     {
      
         return __($this->get('type'),[],'messages','partners_polluter');
     }
     
     
     function getModeI18n()
     {
         return __($this->get('mode'),[],'messages','partners_polluter');
     }
     
     
     // data-json='{$polluter}'
     function toJson($fields=array())
     {
         $values=new mfArray(parent::toArray($fields));
         return $values->toJson();
     }
     
    function getLayer()
    {
        return $this->_layer_id=$this->_layer_id===null?new PartnerLayer($this->get('layer_id')):$this->_layer_id;
    }
     
     function isType($types="")
    {
         if (is_string($types))
             return in_array($this->get('type'),(array)$types);
         return in_array($this->get('type'),$types);
    }
    
    static function getPollutersForSelect2($site=null)
    {
       $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE mode='contract'".
                           " ORDER BY is_active, name ASC;")               
                ->makeSiteSqlQuery($site); 
        //echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {
           $list[$item->get('id')]=$item;
        }     
        return $list;
    } 
    
    static function getTypes()
    {
        return new mfArray(array('ISO'=>__("ISO"),'BOILER'=>__("BOILER"),'PAC'=>__("PAC"),'ITE'=>__('ITE')));
    }
    
    function  hasCumacMin()
    {
       return (boolean)$this->get('cumac_min');
    }
    
    function  getCumacMin()
    {
       return floatval($this->get('cumac_min'));
    }
    
    function getFormatter()
    {
        return $this->formatter=$this->formatter===null?new PartnerPolluterCompanyFormatter($this):$this->formatter;
    }    
    
    function hasEndAt()
    {
        return (boolean)$this->get('end_at');
    }
    
   /* function getEndAt()
    {
        return $this->_end_at=$this->_end_at===null?new DateFormatter($this->get('end_at')):$this->_end_at;
    }*/
    
    
     static function getWorkPollutersForSelect($site=null)
    {
       $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE is_active='YES' AND mode='work'".
                           " ORDER BY is_active,name ASC;")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {
           $list[$item->get('id')]=$item;
        }     
        return $list;
    }  


     function delete()
    {
        parent::delete();
        mfCacheFile::removeCache('polluters','admin',$this->getSite());         
        return $this;
    }
    
      function hasPrimePrecision()
    {
        return (boolean)$this->get('prime_precesion');
    }
    
    function getPrimePrecision()
    {
        return  $this->get('prime_precesion');
    }
}
