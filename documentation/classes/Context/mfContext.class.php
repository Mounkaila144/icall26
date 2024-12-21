<?php

class mfcontext { 
	static public function getInstance($name = null, $class = __CLASS__);
	static public function createInstance(mfApplicationConfiguration $configuration, $class=__CLASS__);
	public function initialize(mfApplicationConfiguration $configuration);
	public function loadfactories();
	public function getActionStack();
	public function getComponentStack();
	public function getConfigCache();
	public function dispatch();
	public function setFactory($name,$value);
	public function getController();
	public function getRequest();
	public function getRequestCore();
	public function getSite();
	public function getResponse();
	public function getI18N();
	public function getConfiguration();
	public function getDatabaseManager();
	public function getComponentController();
	public function getStorage();
	public function getRouting();
	public function getUser();
	public function getModuleName();
	public function getActionName();
	public function set($name, $object);
	public function has($name);
	public function getFactory($name);
	public function get($name);
	public function getMailer();
	public function setMailerConfiguration($configuration);
	public function getEventManager();
	public function shutdown();
}
