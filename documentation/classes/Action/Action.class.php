<?php

class mfAction { 

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
	public function __set($key, $value);
	public function __isset($name);
	public function __unset($name);
	public function getVariables();
	public function getSecurityValue($name, $default = null);
	function getComponentSecurity($component);
	public function getSecurityCredentialsOperations($name, $default = null);
	public function hasComponentCredential($component);
	public function getCredentials();
	public function getUser();
	public function getRequest();
	public function getResponse();
	public function isSecure();
	public function getController();
	public function redirect($url, $statusCode = 302);
	public function forward($module, $action);
	public function forwardToRoute($name,$parameters=array());
	public function forward404();
	public function forward404File();
	public function forwardIf($condition, $module, $action);
	public function forwardTo401Action();
        public function forwardIfTo401Action($condition);
	public function getMailer();
	public function setViewManager($viewManager);
	public function setViewSecurity($viewSecurity);
	public function getViewSecurity($viewSecurity);
	public function getViewManager();
	public function hasViewManager();
	public function addParameters($parameters);
	public function getParameter($name,$default=null);
	public function getParameters();
	protected function parametersToVariables();
	function getEventDispather();
	function getComponent($componentName,$parameters=array());
	function loadComponent($componentName,$parameters=array());
	function getContent();
	function setContent($content);
	function setCache($cache=true);
	function getCache();
	function executed();
	function isExecuted();
}
