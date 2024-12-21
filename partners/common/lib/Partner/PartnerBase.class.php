<?php

class PartnerBase extends mfObject2 {
     
    protected static $fields=array('name','siret','tva','email','web','fax','phone','coordinates','parameters','comments',
                                   'address1','address2','postcode','city','country','state','ape','mobile','logo',
                                   'is_active','status','created_at','updated_at');
    const table="t_partners_company"; 
    
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
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
      $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
      $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
      $this->is_active=isset($this->is_active)?$this->is_active:"YES";
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
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','YES');
        $this->save();
    }
   
    function getContacts()
    {
        if ($this->isNotLoaded())
            return null;
        if ($this->contacts)
            return $this->contacts;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('company_id'=>$this->get('id')))
                ->setQuery("SELECT *  FROM ".  PartnerContact::getTable().                           
                           " WHERE company_id={company_id}".                           
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          if (!$db->getNumRows())
            return null;
        $this->contacts=new PartnerContactCollection(null,$this->getSite());
        while ($item=$db->fetchObject('PartnerContact'))
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
  /*  public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/products/installers/".$this->get('id');
    }  
    */
    
    function hasFirstContact()
    {
        return $this->getFirstContact();
    }
    
    function getFirstContact()
    {
        if ($this->isNotLoaded())
            return null;
        if ($this->first_contact===null)
        {
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('company_id'=>$this->get('id')))
                    ->setQuery("SELECT *  FROM ".  PartnerContact::getTable().                           
                               " WHERE company_id={company_id}".   
                               " ORDER BY id DESC ".
                               " LIMIT 0,1".
                               ";")               
                    ->makeSiteSqlQuery($this->getSite()); 
               if (!$db->getNumRows())                  
                   $this->first_contact=false;
               else 
                    $this->first_contact=$db->fetchObject('PartnerContact')->setSite($this->getSite())->loaded();
        }
        return $this->first_contact;
    }
    
    function toArray($fields=array())
    {
        $values=parent::toArray($fields);
        if ($this->hasFirstContact())
            $values['contact']=$this->getFirstContact()->toArray(array('firstname','lastname','phone','mobile'));
        return $values;
    }
    
    function __toString()
    {
        return (string)$this->get('name');
    }
    
    function hasEmail()
    {
        return $this->get('email');
    }
    
     function getMobile()
    {
        return new mfString($this->get('mobile'));
    }
    
    
    function toArrayForDocument()
    {
        $values= $this->toArray();
        unset($values['parameters']);
        foreach (['software_editor' ,'software_name' ,'software_version','qualification_reference'] as $field)        
            $values[$field]=$this->getParameters()->get($field);       
        foreach (array('software_date','qualification_date') as $field)
            $values[$field]=CustomerModelEmailI18n::format_date($this->getParameters()->get($field));
        return $values;
    }
    
    function toArrayForTransfer()
    {
        $values=array();
        foreach (array('name','siret','tva','email','web','fax','phone','coordinates','address1',
                       'address2','postcode','city','country','ape','mobile'
                      ) as $field)
        {        
            $values[$field]=$this->get($field);
        }    
        // foreign keys
        
        return $values;
    }
    
    function addContract(CustomerCOntract $contract)
    {
        if ($this->contracts===null)
            $this->contracts=new CustomerContractCollection(null,$this->getSite());
        if (isset($this->contracts[$contract->get('id')]))
            return $this;
        $this->contracts[$contract->get('id')]=$contract;
        return $this;
    }
    
    function getContracts()
    {
        if ($this->contracts===null)
            $this->contracts=new CustomerContractCollection(null,$this->getSite());
        return $this->contracts;
    }
    
    
     function save()
     {
         parent::save();
         mfCacheFile::removeCache('contract_financial_partner','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('contract_financial_partner','admin',$this->getSite());         
         return $this;
     }
     
     
     function getParameters()
     {
         return $this->_parameters=$this->_parameters===null?new PartnerParameters($this->get('parameters')):$this->_parameters;
     }
     
    function getFormatter()
    {
        return $this->formatter=$this->formatter===null?new PartnerFormatter($this):$this->formatter;
    }
    
    function hasParameters()
    {
        
         return (boolean)$this->get('parameters');
    }
    
    
      public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/partners/".$this->get('id');
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
                 "urlPath"=>url("/nocache/data/partners/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/partners/".$this->get('id')."/".$this->get('logo'),"web","frontend",$this->getSite())
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
    
}
