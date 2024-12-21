<?php

class mfActionComponent { 

	public function __construct($context,$moduleName, $blockName,$parameters=array());
	public function initialize($context,$moduleName, $blockName,$parameters=array());
	function configure();
	abstract function execute(mfWebRequest $request);
	public function preExecute();
	public function postExecute();
	public function getModuleName();
	public function getComponentName();
	public function getBlockName();
	public function getUser();
	public function getRequest();
	public function getResponse();
	public function getModuleDirectory($default="");
	public function getTemplate();
	public function setTemplate($template);
	public function getCacheID();
	public function __set($key, $value);
	public function __isset($name);
	public function __unset($name);
	public function getVariables();
	public function getController();
	public function getParameter($name,$default=null);
	public function hasParameter($name);
	public function getParameters();
	public function getContent();
	public function hasContent();
	public function setContent($content);
	public function forward($componentName,$parameters=array());
	public function setViewManager($viewManager);
	public function getViewManager();
	public function getMailer();
	public function getMessage();
	protected function addJavascript($file,$options=array());
	function setID($id);
	function getID();
	protected function setInternalCache($state=false);
	function getInternalCache();
	function __toString();
	function getEventDispather();
	function getComponent($componentName,$parameters=array());
}
