<?php

class mfModuleConfig { 

	function __construct($config_file);
	function getModule();
	function getConfigFile();
}
class mfModuleManagerBase { 

	protected function getModulesFromConfigFiles($configFiles);
	public static function getInstance();
	function hasModule($name);
}
