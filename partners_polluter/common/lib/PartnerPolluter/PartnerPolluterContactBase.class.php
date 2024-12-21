<?php


class PartnerPolluterContactBase extends mfObject2 {
    
    protected static $fields=array('company_id','sex','firstname','lastname',
                                   'email','phone','mobile','fax','function',
                                   'created_at','updated_at');
    const table="t_partner_polluter_contact"; 
     protected static $foreignKeys=array(
                                         'company_id'=>'PartnerPolluterCompany',    
                                        ); 
         
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
         return $this->loadByEmail((string)$parameters);
      }   
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
      $db->setParameters(array( 'firstname'=>$this->get('firstname'),
                                'lastname'=>$this->get('lastname'),
                                $this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE firstname='{firstname}' AND lastname='{lastname}'".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    
     function getCompany()
    {
        if ($this->_company_id===null)
        {
           $this->_company_id=new PartnerPolluterCompany($this->get('company_id'),$this->getSite()) ;
        }    
        return $this->_company_id;
    }
    
    
    
    function toArrayForDocument()
    {
        $values=array();
        foreach (parent::toArray() as $idx=>$value)
            $values[$idx]= mb_strtoupper ($value);
        return $values;
    }
    
}
