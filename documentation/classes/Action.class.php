<?php


abstract class mfAction {
    
  public function __construct($context,$moduleName, $actionName,$options=array());
  public function initialize($context,$moduleName, $actionName,$options=array());  
  function configure();
  abstract function execute(mfWebRequest $request);
  public function preExecute();
  public function postExecute();
  public function getCacheKey();
  public function getModuleName();
  public function getModuleDirectory($default="");
  public function getActionName();
  public final function getContext();  
  public function forward404();
  public function forward404File();
  public function forwardIf($condition, $module, $action);
  protected function forwardTo401Action();  
  public function getMailer();   
}

