<?php

class CustomerMeetingProductBase extends mfObject2 {
     
    
    protected static $fields=array('meeting_id','product_id','details','status','created_at','updated_at');
    const table="t_customers_meeting_product"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting','product_id'=>'Product'); // By default
 
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['product_id']) && isset($parameters['meeting_id']))
             return $this->loadbyProductIdAndMeetingId((string)$parameters['product_id'],(string)$parameters['meeting_id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         
      }   
    }
    
    protected function loadbyProductIdAndMeetingId($product_id,$meeting_id)
    {         
         $this->add(array('product_id'=>$product_id,'meeting_id'=>$meeting_id));
         $db=mfSiteDatabase::getInstance()
            ->setParameters(array('product_id'=>$product_id,'meeting_id'=>$meeting_id))    
            ->setObjects(array('CustomerMeeting','Product','CustomerMeetingProduct'))
            ->setQuery("SELECT {fields} FROM ".self::getTable().
                    " LEFT JOIN ".self::getOuterForJoin('product_id').
                    " LEFT JOIN ".self::getOuterForJoin('meeting_id').
                    " WHERE product_id='{product_id}' AND meeting_id='{meeting_id}';")
            ->makeSiteSqlQuery($this->site);  
         if (!$db->getNumRows())
             return false;
         $items=$db->fetchObjects();
         $this->set('product_id',$items->getProduct()); 
         $this->set('meeting_id',$items->getCustomerMeeting());
         $this->toObject($items->getCustomerMeetingProduct());
         return true;
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
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
   
    public function getProduct()
    {      
        if ($this->_product_id===null)
        {
            $this->_product_id=new Product($this->get('product_id'),$this->getSite());          
        }    
        return $this->_product_id;
    }
    
    function getMeeting()
    {
        if ($this->_meeting_id===null)
        {
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());
        }    
        return $this->_meeting_id;
    }       
   
}
