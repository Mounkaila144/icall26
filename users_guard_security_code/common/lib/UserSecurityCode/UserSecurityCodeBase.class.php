<?php

class UserSecurityCodeBase extends mfObject2 {
    
    protected static $fields=array('code','number','status','user_id','created_at','updated_at');
    const table="t_users_security_code"; 
    protected static $foreignKeys=array('user_id'=>'User');     
            
    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);   
        $this->getDefaults(); 
        if ($parameters === null)  return $this;      
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {
            if (isset($parameters['id']))
                return $this->loadbyId((string)$parameters['id']);         
             if (isset($parameters['user']) && isset($parameters['code']))
                return $this->loadbyUserAndCode($parameters['user'],$parameters['code']); 
                if (isset($parameters['user']))
                return $this->loadbyUser2($parameters['user']); 
            return $this->add($parameters); 
        }   
        else
        {
            if ($parameters instanceof User)
               return $this->loadByUser($parameters);
            if (is_numeric((string)$parameters)) 
               return $this->loadbyId((string)$parameters);                         
        }   
    }
    
    
    protected function loadByUser(User $user)
    {       
        $this->set('user_id',$user);   
    }
    
    protected function executeLoadById($db)
    {       
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';");        
        $db->makeSiteSqlQuery($this->site);       
    }
    
     protected function loadbyUser2(User $user)
    {               
        if ($user->isNotLoaded())
            return $this;
        $db = mfSiteDataBase::getInstance()
           ->setParameters(array('user_id'=>$user->get('id')))
           ->setQuery("SELECT * FROM ".self::getTable().
                     " WHERE status='ACTIVE' AND user_id='{user_id}' ".
                     " ORDER BY created_at DESC ".
                     " LIMIT 0,1;")        
           ->makeSiteSqlQuery($this->site); 
        return $this->rowToObject($db);
    }
    
    protected function loadbyUserAndCode(User $user,$code)
    {               
        if ($user->isNotLoaded())
            return $this;
        $db = mfSiteDataBase::getInstance()
           ->setParameters(array("code"=> $code,'user_id'=>$user->get('id')))
           ->setQuery("SELECT * FROM ".self::getTable()." WHERE status='ACTIVE' AND user_id='{user_id}' AND code='{code}';")        
           ->makeSiteSqlQuery($this->site); 
        return $this->rowToObject($db);
    } 
    
    protected function getDefaults()
    {
        $this->status=isset($this->status)?$this->status:'ACTIVE';              
        $this->number=isset($this->number)?$this->number:0;  
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
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;");      
        $db->makeSiteSqlQuery($this->site);       
    }
    
    protected function executeDeleteQuery($db)
    {         
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;");
        $db->makeSiteSqlQuery($this->site);       
    }
    
  /*  protected function executeIsExistQuery($db)    
    {
        $key_condition = ($this->getKey())?" AND ".self::getKeyName()."!={id};":"";
        $db->setParameters(array("ip"=> $this->get("ip")))
           ->setQuery("SELECT id FROM ".self::getTable()." WHERE ip='{ip}'")
           ->makeSiteSqlQuery($this->site);
    }*/

    function getCreatedAt()
    {
        return new DayTime($this->get('created_at'));
    }
    
   /* static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())                
            ->setQuery("TRUNCATE ".UserFailedLogin::getTable().";")               
            ->makeSiteSqlQuery($site);       
        $db->setParameters(array())                
            ->setQuery("TRUNCATE ". SiteIpBlacklist::getTable().";")               
            ->makeSiteSqlQuery($site);       
    }    */
    
   /* function getFormatter()
    {
        if ($this->formatter==null)
        {
            $this->formatter=new UserFailedLoginFormatter($this);
        }    
        return $this->formatter;
    }*/
    
   
    function getUser()
    {
        return $this->_user_id=$this->_user_id ===null?new User($this->get('user_id'),'superadmin', $this->getSite()):$this->_user_id;
    }
    
    
    function create()
    {
        if ($this->getUser()->isNotLoaded())
            return $this;
        $this->clean();
        $this->set('code',mfTools::generatePassword(6, "NUMERIC"));
        $this->save();       
        return $this;
    }
    
    static function findByCode($code)
    {        
        if (!$user= mfcontext::getInstance()->getUser()->getStorage()->read('user'))
            return false;   
        // time 5 mn
        $token = new self(array('user'=>$user,'code'=>$code));
        if ($token->isLoaded())
           return $token;
        return null;                        
    }
    
    function clean()
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('user_id'=>$this->get('user_id')))
            ->setQuery("UPDATE ".self::getTable(). 
                       " SET status='DELETE'".
                       " WHERE ".self::getTableField('user_id')."='{user_id}'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());
        return $this;
    }
    
     static function cleanUp(User $user,$site=null)
    {
         if ($user->isNotLoaded())
             return $this;
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('user_id'=>$user->get('id')))
            ->setQuery("UPDATE ".self::getTable(). 
                       " SET status='DELETE'".
                       " WHERE ".self::getTableField('user_id')."='{user_id}'".
                       ";")               
            ->makeSiteSqlQuery($site);
        return $this;
    }
    
    static function updateNumber()
    {
        if (!$user= mfcontext::getInstance()->getUser()->getStorage()->read('user'))
            return ;;
        if ($user->isNotLoaded())
             return ;
        $token = new self(array('user'=>$user));
        if ($token->isNotLoaded())
           return ;
        $token->set('number',$token->get('number')+1);
        $token->save();
        return ;
    }
    
    static function isOver()
    {
        if (!$user= mfcontext::getInstance()->getUser()->getStorage()->read('user'))
            return true;    
        if ($user->isNotLoaded())
             return true;
        $token = new self(array('user'=>$user));
        if ($token->isNotLoaded())
           return true; 
        if ($token->get('number') > 3)
            return true;
        return false;
    }
    
    
    function __toString() {
        return (string)$this->get('code');
    }
}
