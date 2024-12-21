<?php

 
class UserValidationTokenBase extends mfObject3 {
   
    protected static $fields=array('token','message','callback','type','status','user_id','created_at','updated_at');
    const table="t_users_validation_token"; 
     protected static $foreignKeys=array('user_id'=>'User'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['token']) && isset($parameters['user']) && $parameters['user'] instanceof User)              
             return $this->loadbyTokenAndUser((string)$parameters['token'],$parameters['user']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {                  
       //     return $this->loadByUser($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);            
      }   
    }
           
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");        
       $this->status=isset($this->status)?$this->status:"ACTIVE"; 
    }     
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));   
    }           
    
   /* protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE  name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
      protected function loadbyTokenAndUser($token,User $user)
    {             
         $this->set('user_id',$user);        
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id'),'token'=>$token))
                ->setQuery("SELECT * FROM ".self::getTable().                                       
                           " WHERE user_id='{user_id}' AND token='{token}' AND status='ACTIVE'".
                           ";")
                ->makeSiteSqlQuery($this->getSite());         
         return $this->rowtoObject($db);        
    }   
    
     protected function loadbyUser(User $user)
    {             
         $this->set('user_id',$user);        
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable().                                       
                           " WHERE user_id='{user_id}' AND status='ACTIVE'".
                           ";")
                ->makeSiteSqlQuery($this->getSite());         
         return $this->rowtoObject($db);        
    }   
    
    function cleanUp($type)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$this->get('user_id'),'type'=>$type))
                ->setQuery("UPDATE ".self::getTable().                                       
                           " SET status='DELETE'".
                           " WHERE user_id='{user_id}' AND type='{type}'".
                           ";")
                ->makeSiteSqlQuery($this->getSite()); 
        return $this;
    }
    
    function create($type,$message,$callback,User $user)
    {
        $this->set('user_id',$user);   
        $this->cleanUp($type);
        $this->set('token',mfTools::generatePassword(64));  
        $this->set('type',$type);
        $this->set('callback',$callback);
        $this->set('message',$message);           
        return $this->save();
    }
    
    function disable()
    {
        return $this->set('status','DELETE')->save();
    }
    
    
    function getCallback()
    {
        return url().substr($this->get('callback'),7)."&token=".$this->get('token');
    }
    
    function getUser()
    {
        return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),'admin',$this->getSite()):$this->_user_id;
    }
    
    function getCreatedAt()
    {
        return new DateTimeFormatter($this->get('created_at'));
    }
    
    static function getUsersForSelect($site=null)
    {
        $list=new mfArray();        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ". UserValidationToken::getTable().
                           " INNER JOIN ".UserValidationToken::getOuterForJoin('user_id').
                           " WHERE application ='admin'".
                           " GROUP BY ".User::getTableFIeld('id').
                           " ORDER BY firstname ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;
        while ($item=$db->fetchObject('User'))
        { 
            $list[$item->get('id')]=strtoupper((string)$item);
        }               
        return $list;
    }     
    
    static function getTypesForSelect($site=null)
    {
        $list=new mfArray();        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT type FROM ". UserValidationToken::getTable().                          
                           " GROUP BY ".UserValidationToken::getTableField('type').
                           " ORDER BY type ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;
        while ($row=$db->fetchRow())
        { 
            $list[$row[0]]=strtoupper($row[0]);
        }                    
        return $list;
    }     
}
