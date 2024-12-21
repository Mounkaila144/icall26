<?php

abstract class cronAction {
    
    protected
    $cron                   = null,
    $moduleName             = '',
    $actionName             = '',
    $dispatcher             = null;
    
  public function __construct($moduleName, $actionName,$cron)
  {
    $this->initialize($moduleName, $actionName,$cron);
  }
  
  public function initialize($moduleName, $actionName,$cron)
  {
    $this->moduleName             = $moduleName;
    $this->actionName             = $actionName;   
    $this->cron                   = $cron;
    $this->dispatcher             = mfContext::getInstance()->getEventManager();
    $this->configure();
  }
  
  function configure() {  }
  
  abstract function execute();

  public function getModuleName()
  {
    return $this->moduleName;
  }
  
  public function getActionName()
  {
    return $this->actionName;
  }

   function getEventDispather()
   {
    return $this->dispatcher;
   }     
   
   function getCron()
   {
       return $this->cron;
   }
   
  public function getMailer()
  {
    return mfContext::getInstance()->getMailer();
  }
  
 
}

