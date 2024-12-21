<?php



class CustomerContractCompanyBase extends mfObject2 {
 
    protected static $fields=array('name','commercial','siret','tva','picture','email','web','fax','phone','coordinates',
                                   'address1','address2','postcode','city','country','state','ape','mobile','footer','header',
                                   'stamp','type','footer_text',
                                   'gender','lastname','firstname','function','rcs','rge',                                 
                                   //'email_system',
                                    'lastname1','firstname1','function1',
                                   'signature','comments','capital',
                                   'is_active','created_at','updated_at');
    
    const table="t_customers_contracts_company";
            
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);
      $this->getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess) {
           if (isset($parameters['id']))
               return $this->loadById((string)$parameters['id']);
           return $this->add($parameters); 
       }  
       else if (is_numeric((string)$parameters)) {
           $this->loadById((string)$parameters);             
       } 
    }

    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE id=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function executeDeleteQuery($db)
    {
         $db->setQuery("DELETE FROM ".self::getTable()." WHERE id=%d;")
            ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site);
    }
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    protected function getDefaults()
    {
       $this->created_at=date("Y-m-d H:i:s");  
       $this->updated_at=date("Y-m-d H:i:s");
       $this->is_active=isset($this->is_active)?$this->is_active:"NO";
       $this->is_site=isset($this->is_site)?$this->is_site:"NO";
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE  name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    // Company directory data
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/contracts/company/".$this->get('id');
    }       
    
    public function getAddress()
    {
        return $this->get('address1')." ".$this->get('address2')." ".$this->get('postcode')." ".$this->get('city');
    }  
        
    public function getCoordinates()
    {
        if ($this->get('coordinates'))
        {             
            $coordinates= new GPSCoordinates($this->get('coordinates'));
            return $coordinates;
        }   
        return null;
    }        
    
    function hasFooter()
    {
        return (boolean)$this->get('footer');
    }
    
     function hasHeader()
    {
        return (boolean)$this->get('header');
    }
    
     function hasPicture()
    {
        return (boolean)$this->get('picture');
    }
    
    function hasStamp()
    {
        return (boolean)$this->get('stamp');
    }
    
     function hasSignature()
    {
        return (boolean)$this->get('signature');
    }
    /* =================================== P I C T U R E =========================================== */
    
    public function getPicture()
    {
      if (!$this->get('_picture'))      
      {    
         $this->_picture=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('picture'),
                 "urlPath"=>url("/nocache/data/contracts/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/contracts/company/".$this->get('id')."/".$this->get('picture'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_picture;     
    }
    
    public function deletePicture()
    {
        $this->getPicture()->remove(); 
        $this->set('picture','');
        $this->save();
    }       
    
    public function getNameForPicture()
    {
       return preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
    /* =================================== H E A D E R =========================================== */
    public function getHeader()
    {
      if (!$this->get('_header'))      
      {    
         $this->_header=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('header'),
                 "urlPath"=>url("/nocache/data/contracts/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/contracts/company/".$this->get('id')."/".$this->get('header'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_header;     
    }
    
    public function getNameForHeader()
    {
       return __("header")."-".preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
     public function deleteHeader()
    {
        $this->getHeader()->remove(); 
        $this->set('header','');
        $this->save();
    }  
    
    /* =================================== F O O T E R =========================================== */
    public function getFooter()
    {
      if (!$this->get('_footer'))      
      {    
         $this->_footer=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('footer'),
                 "urlPath"=>url("/nocache/data/contracts/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/contracts/company/".$this->get('id')."/".$this->get('footer'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_footer;     
    }
    
    public function getNameForFooter()
    {
       return __("footer")."-".preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
    public function deleteFooter()
    {
        $this->getFooter()->remove(); 
        $this->set('footer','');
        $this->save();
    }  
    
     /* =================================== S T A M P =========================================== */
    
    public function getStamp()
    {
      if (!$this->get('_stamp'))      
      {    
         $this->_stamp=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('stamp'),
                 "urlPath"=>url("/nocache/data/contracts/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/contracts/company/".$this->get('id')."/".$this->get('stamp'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_stamp;     
    }
    
    public function deleteStamp()
    {
        $this->getStamp()->remove(); 
        $this->set('stamp','');
        $this->save();
    }       
    
    public function getNameForStamp()
    {
       return __("stamp")."-".preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
     /* =================================== S I G N A T U R E =========================================== */
    
    public function getSignature()
    {
      if (!$this->get('_signature'))      
      {    
         $this->_signature=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('signature'),
                 "urlPath"=>url("/nocache/data/contracts/company/".$this->get('id')."/","web","frontend",$this->getSite()),
                 "url"=>url("/nocache/data/contracts/company/".$this->get('id')."/".$this->get('signature'),"web","frontend",$this->getSite())
              ));
      }
      return $this->_signature;     
    }
    
    public function deleteSignature()
    {
        $this->getSignature()->remove(); 
        $this->set('signature','');
        $this->save();
    }       
    
    public function getNameForSignature()
    {
       return __("signature")."-".preg_replace('/[^a-z0-9]/iu','', $this->get('name')); 
    }  
    
    function isAutoEnterprise()
    {             
        if (!$this->get('tva') && $this->get('ape'))
            return true;    
        if ($this->get('autoentreprise')=='YES')
            return true;
        return false;
    }    
    
    function toArray($fields=null)
    {
        $values=  parent::toArray($fields);
        if ($this->hasPicture())
            $values['picture']=array('url'=>$this->getPicture()->getUrl());     
        if ($this->hasHeader())
            $values['header']=array('url'=>$this->getHeader()->getUrl());    
        if ($this->hasFooter())
            $values['footer']=array('url'=>$this->getFooter()->getUrl());
         if ($this->hasStamp())
            $values['stamp']=array('url'=>$this->getStamp()->getUrl());
          if ($this->hasSignature())
            $values['signature']=array('url'=>$this->getSignature()->getUrl());
        return $values;
    } 
    
    
    function toArrayForPdf()
    {
        $values=$this->toArray();                
        $values['email']=new EmailFormatter($this->get('email'));   
        $values['phone']=new mfString($this->get('phone'));
        $values['mobile']=new mfString($this->get('mobile'));
        $values['siret']=new mfString($this->get('siret'));
        $values['postcode']=new mfString($this->get('postcode'));
        $values['firstname']=new mfString($this->get('firstname'));
        $values['lastname']=new mfString($this->get('lastname'));
        $values['function']=new mfString($this->get('function'));
        $values['firstname1']=new mfString($this->get('firstname1'));
        $values['lastname1']=new mfString($this->get('lastname1'));
        $values['function1']=new mfString($this->get('function1'));
        $values['address1_postcode_city']= $values['address1']." ".$values['postcode']." ".$values['city'];
        $values['phone_email']= 'TEL : '.(string)$values['phone']." EMAIL : ".(string)$values['email'];
        $values['ape_capital']= 'APE : '.$values['ape']." AU CAPITAL DE : ".$values['capital']." ".$values['comments'];
        $values['name_address1_postcode_city']=$values['name']." ".$values['address1_postcode_city'];
        $values['postcode_city']= $values['postcode']." ".$values['city'];         
        $values['mediator']=(string)$values['firstname1']." ".(string)$values['lastname1'];        
        return $values;
    } 
    
    
    static function initializeSite($site=null)
    {                 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".self::getTable().";")               
                ->makeSiteSqlQuery($site); 
    
    }
    
     function getEmailWithName()
   {
       return array($this->get('email')=>$this->get('commercial'));
   }
   
   static function getActiveCompaniesForSelect($site=null){
        static $values=null;      
        if ($values)
            return $values;   
        $values=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " WHERE is_active='YES' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }              
        return $values;
    }
    
    static function getCompaniesForSelect($site=null){
        static $values=null;      
        if ($values)
            return $values;   
        $values=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }              
        return $values;
    }
    
    
    static function getActiveCompaniesByTypeNewContractForSelect(CustomerContractNewForm $form,$site=null){          
        $values=new mfArray();        
        if (!$form->hasPolluter())
            return $values;            
        $contract_defaults=$form->getDefault('contract');               
        if (!$contract_defaults['polluter_id'])
        {               
            return $values;
        }
        else
        {                  
            $polluter=new  DomoprimePollutingCompany($contract_defaults['polluter_id']);
            if ($polluter->isNotLoaded())
                 return $values;                           
        }    
        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('type'=>$polluter->get('type')))
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " WHERE is_active='YES' AND type='{type}' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }              
        return $values;
    }
    
    
    
    static function getActiveCompaniesByTypeViewContractForSelect(CustomerContractViewForm $form,$site=null){           
        $values=new mfArray();
        if (!$form->hasPolluter())
            return $values;              
        if (!$form->getDefault('polluter_id') || $form->hasValidator('polluter_id'))
        {             
             $polluter = $form->getContract()->getPolluter();              
        }
        elseif (!$form->getDefault('polluter_id'))
        {         
            return $values;
        }
        else
        {           
            $polluter=new  DomoprimePollutingCompany($form->getDefault('polluter_id'));
            if ($polluter->isNotLoaded())
                 return $values;                        
        }                
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('type'=>$polluter->get('type')))
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " WHERE is_active='YES' AND type='{type}' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }                
        return $values;
    }
    
    static function getActiveCompaniesByTypeNewMeetingForSelect(CustomerMeetingNewForm $form,$site=null){          
        $values=new mfArray();        
        if (!$form->hasPolluter())
            return $values;            
        $contract_defaults=$form->getDefault('meeting');               
        if (!$contract_defaults['polluter_id'])
        {               
            return $values;
        }
        else
        {                  
            $polluter=new  DomoprimePollutingCompany($contract_defaults['polluter_id']);
            if ($polluter->isNotLoaded())
                 return $values;                           
        }    
        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('type'=>$polluter->get('type')))
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " WHERE is_active='YES' AND type='{type}' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }              
        return $values;
    }
    
    
    
    static function getActiveCompaniesByTypeViewMeetingForSelect(CustomerMeetingViewForm $form,$site=null){           
        $values=new mfArray();
        if (!$form->hasPolluter())
            return $values;              
        if (!$form->getDefault('polluter_id') || $form->hasValidator('polluter_id'))
        {             
             $polluter = $form->getMeeting()->getPolluter();              
        }
        elseif (!$form->getDefault('polluter_id'))
        {         
            return $values;
        }
        else
        {           
            $polluter=new  DomoprimePollutingCompany($form->getDefault('polluter_id'));
            if ($polluter->isNotLoaded())
                 return $values;                        
        }                
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('type'=>$polluter->get('type')))
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " WHERE is_active='YES' AND type='{type}' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }                
        return $values;
    }
    
    
    function __toString() {
        return (string)$this->get('name');
    }
    
      function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new CustomerContractCompanyFormatter($this);
        }
        return $this->formatter;
    }
    
      function toArrayForApi($options)
    {
        if ($this->formatter_api===null)
        {
            $this->formatter_api=new CustomerContractCompanyItemFormatterApi($this,$options);
        }
        return $this->formatter_api;
    }
    
    
    function save()
     {
         parent::save();
         mfCacheFile::removeCache('companies','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('companies','admin',$this->getSite()); 
         return $this;
     }
}

