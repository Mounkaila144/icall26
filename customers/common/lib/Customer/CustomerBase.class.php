<?php

class CustomerBase extends mfObject2 {
     
    protected static $fields=array('gender','firstname','lastname','email','phone','mobile','phone1','birthday','salary','mobile2',
                                   'company',
                                   'union_id','age','occupation','created_at','updated_at','status');
    const table="t_customers"; 
    protected static $foreignKeys=array('union_id'=>'CustomerUnion'); // By default
    protected static $fieldsNull=array('birthday'); // By default


    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['lastname']) && isset($parameters['firstname']))
             return $this->loadbyFirstnameAndLastname((string)$parameters['firstname'],(string)$parameters['lastname']); 
          if (isset($parameters['phone']))
             return $this->loadbyPhoneOrMobile((string)$parameters['phone']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         return $this->loadByEmail((string)$parameters);
      }   
    }
    
     protected function loadByPhoneOrMobile($phone)
    {       
         $this->set('phone',$phone);
         $db=mfSiteDatabase::getInstance()->setParameters(array('phone'=>$phone));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE phone='{phone}' OR mobile='{phone}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByFirstnameAndLastname($firstname,$lastname)
    {
         $this->set('firstname',$firstname);
         $this->set('lastname',$lastname);
         $db=mfSiteDatabase::getInstance()->setParameters(array('firstname'=>$firstname,'lastname'=>$lastname));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE firstname='{firstname}' AND lastname='{lastname}';")
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
       $this->status=isset($this->status)?$this->status:"ACTIVE";
       $this->union_id=isset($this->union_id)?$this->union_id:0;
      // $this->gender=isset($this->gender)?$this->gender:'Mr';
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
      
       $db->setParameters($parameters)
          ->setQuery("")
          ->makeSiteSqlQuery($this->site);     
    }
    
        
    function getLastName($ucfirst=false)
    {
        if ($ucfirst)
            return new mfString(ucfirst($this->lastname));
        return new mfString($this->lastname);
    }
    
    function getFirstName($ucfirst=false)
    {
        if ($ucfirst)
            return new mfString(ucfirst($this->lastname));
        return new mfString($this->firstname);
    }
    
    function hasEmail()
    {
        return (boolean)$this->email;
    }
    
    function getEmail()
    {
        return $this->email;
    }
    
    function getPassword()
    {
        return $this->password;
    }             
    
    function getGender()
    {
        return $this->get('gender');
    }
    
    
    // FOR DISPLAY
    public function __toString()
    {      
       return (string) trim($this->firstname).' '.trim($this->lastname);
    }
    
    public function getName($ucfirst=true)
    {
       if ($ucfirst)
            return ucfirst($this->firstname)." ".ucfirst($this->lastname);
        return $this->__toString();  
    }         

    // User directory data
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/customers/".$this->get('id');
    }
        
    function getAddress()
    {
        if ($this->address===null)
        {    
            if ($this->isLoaded())
            {                  
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('customer_id'=>$this->get('id')))
                         ->setQuery("SELECT * FROM ".CustomerAddress::getTable()." WHERE customer_id='{customer_id}';")
                         ->makeSiteSqlQuery($this->getSite());  
                if ($db->getNumRows())
                {
                   $this->address=$db->fetchObject('CustomerAddress');
                   $this->address->loaded();
                   $this->address->site=$this->getSite();
                   return $this->address;
                }
            }    
            $this->address=new CustomerAddress(null,$this->getSite());    
            $this->address->set('customer_id',$this);
        }    
        return $this->address;
    }
    
    function getFirstContact()
    {
        if (!$this->first_contact)
        {
            if ($this->isLoaded())
            {                  
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('customer_id'=>$this->get('id')))
                         ->setQuery("SELECT * FROM ".CustomerContact::getTable()." WHERE customer_id='{customer_id}' AND isFirst='YES';")
                         ->makeSiteSqlQuery($this->getSite());  
                if ($db->getNumRows())
                {
                   $this->first_contact=$db->fetchObject('CustomerContact');
                   $this->first_contact->loaded();
                   $this->first_contact->site=$this->getSite();
                   return $this->first_contact;
                }
            }    
            $this->first_contact=new CustomerContact(null,$this->getSite());   
            $this->first_contact->set('isFirst','YES');
            $this->first_contact->set('customer_id',$this);
        }   
        return $this->first_contact;
    }
    
     function getFirstHouse()
    {
        if (!$this->first_house)
        {
            if ($this->isLoaded())
            {                   
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('customer_id'=>$this->get('id')))
                         ->setQuery("SELECT * FROM ".CustomerHouse::getTable()." WHERE customer_id='{customer_id}';")
                         ->makeSiteSqlQuery($this->getSite());  
                if ($db->getNumRows())
                {
                   $this->first_house=$db->fetchObject('CustomerHouse');
                   $this->first_house->loaded();
                   $this->first_house->site=$this->getSite();                 
                   return $this->first_house;
                }                
            }    
            $this->first_house=new CustomerHouse(null,$this->getSite());   
            $this->first_house->set('customer_id',$this);
            $this->first_house->set('address_id',$this->getAddress());
        }   
        return $this->first_house;
    }
    
    function getFinancial()
    {
        if (!$this->financial)
        {
            if ($this->isLoaded())
            {                  
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('customer_id'=>$this->get('id')))
                         ->setQuery("SELECT * FROM ".CustomerFinancial::getTable()." WHERE customer_id='{customer_id}';")
                         ->makeSiteSqlQuery($this->getSite());  
                if ($db->getNumRows())
                {
                   $this->financial=$db->fetchObject('CustomerFinancial');
                   $this->financial->loaded();
                   $this->financial->site=$this->getSite();
                   return $this->financial;
                }
            }    
            $this->financial=new CustomerFinancial(null,$this->getSite()); 
            $this->financial->set('customer_id',$this);
        }   
        return $this->financial;
    }
    
    function getUnion()
    {
       if (!$this->_union_id) 
       {    
         $this->_union_id= new CustomerUnion($this->get('union_id'),$this->getSite());
       }
       return $this->_union_id;
    }
    
    function getNameForFile()
    {             
        return (string) strtolower(mfTools::I18N_noaccent($this->firstname.'-'.$this->lastname));
    }
    
    function getFormattedPhone()
    {
        return mfString::splitter($this->get('phone'));
    }
    
    function getFormattedMobile()
    {
        return mfString::splitter($this->get('mobile'));
    }
    
    function toArray()
    {
       $values=parent::toArray();
       $values['name']=ucwords((string)$this);
       $values['courtesy']=format_courtesy('Dear',$this->getGender());
       $values['gender']=format_gender($this->getGender(),1,true,true);
       $values['address']=$this->getAddress()->toArray();     
       return $values;
    }
    
    function toArrayForPdf()
    {
       $values=array();
        foreach (parent::toArray() as $name=>$value)
          $values[$name]= mb_strtoupper($value);
       $values['name']=ucwords((string)$this);
       $values['email']=new EmailFormatter($this->get('email')?$this->get('email'):__("Néant"));    
       $values['courtesy']=format_courtesy('Dear',$this->getGender());
       $values['gender']=format_gender($this->getGender(),1,true,true);
       $values['madam']=$this->get('gender')!='Mr'?"1":"0";
       $values['mister']=$this->get('gender')=='Mr'?"1":"0";
       $values['address']=$this->getAddress()->toArrayForPdf();
       $values['phone']=new mfString($this->get('phone'));
       $values['mobile']=new mfString($this->get('mobile')); 
       $values['firstname']=new mfString($this->get('firstname'));
       $values['lastname']=new mfString($this->get('lastname'));
       return $values;
    }
        
    
    
    function isPhoneNotUnique()
    {        
        if ($this->phone_not_unique===null)
        {    
            $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='{id}';":"";
            $db=mfSiteDatabase::getInstance()->setParameters(array('phone'=>$this->get('phone'),'id'=>$this->get('id')));
            $db->setQuery("SELECT count(id) FROM ".self::getTable().
                          " WHERE status='ACTIVE' AND phone='{phone}' AND phone!='' ".$key_condition.";")
               ->makeSiteSqlQuery($this->site);                           
           $row=$db->fetchRow();
           $this->phone_not_unique=($row[0]!=0);            
        }
        return $this->phone_not_unique;
    }
    
    function isMobileNotUnique()
    {    
        if ($this->mobile_not_unique===null)
        {    
            $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='{id}';":"";
            $db=mfSiteDatabase::getInstance()->setParameters(array('mobile'=>$this->get('mobile'),'id'=>$this->get('id')));
            $db->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE status='ACTIVE' AND mobile='{mobile}' AND mobile!='' ".$key_condition.";")
               ->makeSiteSqlQuery($this->site);                           
            $row=$db->fetchRow();
            $this->mobile_not_unique=($row[0]!=0);  
        }
        return $this->mobile_not_unique;
    }    
    
    function getPhones()
    {
        $phones=array();
        foreach (array('phone','phone1','mobile','mobile2') as $field)
        {          
            if (!$this->get($field) || !($this->get($field) > 0))
                continue;         
            $phones[]=$this->get($field);            
        }        
        return $phones;
    }
    
    function hasMobile()
    {
        return (boolean)$this->get('mobile');
    }
  
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new CustomerFormatter($this);
        }   
        return $this->formatter;
    }
    
    function hasBirthday()
    {
        return (boolean)$this->get('birthday');
    }
       

    function disable()
    {
        $this->set('status','DELETE');
        return $this->save();
    }

    function enable()
    {
        $this->set('status','ACTIVE');
        return $this->save();
    }    
    
    
     function toArrayForTransfer()
     {
         $values=array();         
         foreach (array('gender','firstname','lastname','email','phone','mobile','phone1','salary','mobile2','company','age','occupation') as $field)
         {
             $values[$field]=$this->get($field);
         }                  
         $values['address']=$this->getAddress()->toArrayForTransfer();     
         return $values;
     }
     
     function isAdmin()
     {
         return false;
     }
     
     
     function getMobile()
    {
        return new mfString($this->get('mobile'));
    }
    
 
}
