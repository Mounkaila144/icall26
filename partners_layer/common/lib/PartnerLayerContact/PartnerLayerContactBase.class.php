<?php

class PartnerLayerContactBase extends mfObject2 {
     
    protected static $fields=array('company_id','sex','firstname','lastname','email','fax','phone','mobile','status','created_at','updated_at');
    const table="t_partner_layer_contact"; 
    protected static $foreignKeys=array('company_id'=>'PartnerLayerCompany'); // By default
   
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
      }   
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
      $this->sex=isset($this->sex)?$this->sex:"Mr";
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
      $db->setParameters(array('firstname'=>$this->get('firstname'),'lastname'=>$this->get('lastname'),'sex'=>$this->get('sex'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE firstname='{firstname}' AND lastname='{lastname}' AND sex='{sex}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
  /*  public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/products/installers/".$this->get('id');
    }  
    */
    
     function getPartner()
    {
       if (!$this->_company_id)
       {
          $this->_company_id=new PartnerLayerCompany($this->get('company_id'),$this->getSite());          
       }   
       return $this->_company_id;
    }  
    
    function __toString() {
        return (string)$this->get('firstname')." ".$this->get('lastname');
    }
    
    
    
    function toArrayForSelect()
    {
        $values=new mfArray();
        foreach (array('firstname','lastname') as $field)
            $values[$field]= strtoupper($this->get($field));              
        $values['company']=$this->getPartner()->toArrayForSelect()->toArray();
        return $values;
    }
    
    function toArrayForDocument()
    {
        $values=array();
        foreach (parent::toArray() as $idx=>$value)
            $values[$idx]= mb_strtoupper ($value);
        return $values;
    }
    
    
}
