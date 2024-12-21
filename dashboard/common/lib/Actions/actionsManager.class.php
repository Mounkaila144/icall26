<?php


class ActionsManager {

    protected static $instances=array();
    protected $actions=null;
    
    static function getInstance($name)
    {
        if ($site && !$site instanceof Site)
           throw new mfException("Site is invalid in action manager.");   
       if ($site)
           $key=$site->getHost().".".$name;  
       else 
           $key=$name;
       if (self::$instances[$name])
            return self::$instances[$name];
       else
       {
            self::$instances[$name]=new self($name,$site);
            return self::$instances[$name];
       }       
    } 
    
    function __construct($name,$site=null) {     
       $context=mfContext::getInstance(); // Used to config tab file
       $request=$context->getRequest();  // Used to config tab file      
       if ($site==null)
           require_once $context->getConfigCache()->checkConfig('config/actions.php',$name,$name); 
       else                       
           require_once $context->getFactory('configCacheSite')->checkConfig('config/actions.php',$name,$name,$site); 
    }
    
    function getActions()
    {
      return $this->actions;
    }
    
    
    function getComponents()
    {
        if (!$this->components)
        {    
            foreach ($this->getActions() as $name=>$action)
            {
                if (isset($action['component']))
                    $this->components[$name]=$action['component'];
            }
        }
        return $this->components;
    }
    
    
}

