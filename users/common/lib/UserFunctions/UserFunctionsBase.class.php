<?php

class UserFunctionsBase extends mfObject2 {
     
    const table="t_users_functions"; 
    protected static $fields=array('user_id','function_id');   
    protected static $foreignKeys=array('function_id'=>'UserFunction','user_id'=>'User'); // By default
    
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
      
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
      
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
   /*   $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   */   
    }
    
    function getUserFunction()
    {
       return $this->_function_id=$this->_function_id===null?new UserFunction($this->get('function_id'),$this->getSite()):$this->_function_id;
    }   
    
       function getUser()
    {
       return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),'admin',$this->getSite()):$this->_user_id;
    }  
        
       
    static function createFunctionsForUser(User $user,$functions=array())
    {
       if ($user->isNotLoaded()) 
           return ;
       if (!$functions) 
           return ;
       $function_collection=new UserFunctionCollection(null,$user->getSite());
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".UserFunction::getTable().
                           " WHERE name IN('".$functions->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($user->getSite()); 
        if ($db->getNumRows())
        {
             while ($item=$db->fetchObject('UserFunction'))
            {          
                $function_collection[$item->get('id')]=$item->loaded()->setSite($user->getSite());
                $functions->findAndRemove($item->get('name'));
            }
            $function_collection->loaded();
        }   
        foreach ($functions as $function)
        {
            $item=new UserFunction(null,$user->getSite());
            $item->set('name',$function);
            $function_collection[$function]=$item;
        }    
        $function_collection->save();
        // I18n
        $function_i18n_collection=new UserFunctionI18nCollection(null,$user->getSite());
        foreach ($functions as $function)
        {
           $item=new  UserFunctionI18n(null,$user->getSite());
           $item->add(array('function_id',$function_collection[$function],'value'=>$function));
           $function_i18n_collection[]=$item;
        }    
        $function_i18n_collection->save();
        
        $function_user_collection=new UserFunctionsCollection(null,$user->getSite());
        foreach ($function_collection as $function)
        {
            $item=new UserFunctions(null,$user->getSite());
            $item->add(array('user_id'=>$user,'function_id'=>$function));
            $function_user_collection[]=$item;
        }
        $function_user_collection->save();
        
    }        
}
