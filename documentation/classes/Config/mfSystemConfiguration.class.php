<?php

class mfSystemConfiguration { 

	public function __construct();
	public function setRootDir();
	public function setCacheDir($cacheDir);
	static public function getActive();
	static public function hasActive();
	public function getModulesSitedir($configPath);
	public function getModulesdir($configPath);
	public function getModuleDirectories();
	public function getModulesNames();
	function loadModules();
	function getModulesPaths();
	function getModulesPaths($site=null);
	function getModules($site=null);
	function getModulePath($moduleName,$site=null);
}
