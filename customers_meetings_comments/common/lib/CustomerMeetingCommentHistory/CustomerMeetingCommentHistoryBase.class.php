<?php

class CustomerMeetingCommentHistoryBase extends mfObject2 {
     
    protected static $fields=array('user_id','user_application','comment_id','updated_at','created_at');
    const table="t_customers_meetings_comments_history"; 
    protected static $foreignKeys=array('user_id'=>'User','comment_id'=>'CustomerMeetingComment'); // By default
   
       
            
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
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
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
    
   
  /*  public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/customers/smss/".$this->get('id');
    }  */
   
     function getComment()
    {
       if (!$this->_comment_id)
       {
          $this->_comment_id=new CustomerMeetingComment($this->get('comment_id'),$this->getSite());          
       }   
       return $this->_comment_id;
    }  
    
    function getUser()
    {
       if (!$this->_user_id)
       {
          $this->_user_id=new User($this->get('user_id'),$this->get('user_application'),$this->getSite());          
       }   
       return $this->_user_id;
    }  
       
    function setUser($user)
    {
        $this->set('user_id',$user);
        $this->set('user_application',$user->get('application'));
        return $this;
    }
    
     function setComment($comment)
    {
        $this->set('comment_id',$comment);
        return $this;
    }
    
    function isSuperAdminUser()
    {
        return ($this->get('user_application')=='superadmin');
    }
    
    
}
