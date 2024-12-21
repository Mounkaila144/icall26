<?php
 
 
class SiteOversightUserActionBase extends mfObject3 {
    
    protected static $fields=array('module','action','message','ip','user_id','creator_id','criticity','created_at','updated_at');
    protected static $foreignKeys=array('user_id'=>'User','creator_id'=>'User');  
   protected static $fieldsNull=array('user_id'); // By default
    const table="t_site_oversight_user_action"; 
    
      protected static $instance =null;
    
    static function getInstance($site=null)
    {
        if (self::$instance===null)
            self::$instance=new self(null,$site);
        return self::$instance;
    } 
    
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
    
    protected function getDefaults()
    {      
       $this->setIfNotNull(array(         
           'criticity'=>'0',
           'created_at'=>date("Y-m-d H:i:s"),
           'updated_at'=>date("Y-m-d H:i:s")
       ));
    }     
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));    
    }   
    
     
  /*  protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
      

    function getCreatedAt()
    {
        return new DateTimeFormatter($this->get('created_at'));
    }
    
    
    function addMessage($module,$action,$message,$criticity,User $user=null)
    {
        $this->add(array(
            'user_id'=>$user,
            'module'=>$module,
            'action'=>$action,                    
            'criticity'=>$criticity,
            'ip'=>mfCOntext::getInstance()->getRequest()->getIP(),
            'creator_id'=>mfCOntext::getInstance()->getUser()->getGuardUser(),
            'message'=>$message instanceof mfArray?$message->implode():(string)$message
        ));    
        return $this;
    }
    
    function hasUser()
    {
        return (boolean)$this->get('user_id');
    }
    
    function getUser()
    {
        return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),'admin',$this->getSite()):$this->_user_id;
    }
    
    function getCreator()
    {
        return $this->_creator_id=$this->_creator_id===null?new User($this->get('creator_id'),'admin',$this->getSite()):$this->_creator_id;
    }
    
  /*  static function getMessages($site=null)
    {               
        $list=new SiteOversightMessageCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
            ->setQuery("SELECT * FROM ".self::getTable().
                       " WHERE is_sent='NO'".
                       ";")               
            ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return $list;           
        while ($item=$db->fetchObject('SiteOversightMessage'))
        {               
           $list[$item->get('id')]=$item->loaded()->setSite($site);
        }
        $list->loaded();
       return $list;
    }    */    
    
     static function getUsersForSelect($site=null)
    {               
        $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
            ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".self::getTable().
                       " INNER JOIN ".self::getOuterForJoin('user_id').
                       " GROUP BY user_id".
                       ";")               
            ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return $list;           
        while ($item=$db->fetchObject('User'))
        {               
           $list[$item->get('id')]=$item->getFormatter()->getUser()->upper();
        }      
       return $list;
    } 
    
      static function getCreatorsForSelect($site=null)
    {               
        $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
            ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".self::getTable().
                       " INNER JOIN ".self::getOuterForJoin('creator_id').
                       " GROUP BY user_id".
                       ";")               
            ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return $list;           
        while ($item=$db->fetchObject('User'))
        {               
           $list[$item->get('id')]=$item->getFormatter()->getUser()->upper();
        }      
       return $list;
    } 
}
