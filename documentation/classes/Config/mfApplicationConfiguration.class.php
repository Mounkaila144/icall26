<?php

class mfApplicationConfiguration { 

	public function __construct($environment,$debug);
	public function configure();
	public function getConfigCache();
	public function getAppName($application);
	public function setRootDir();
	public function setAppDir($appDir);
	public function setCacheDir($cacheDir);
	public function getTemplateModuleDirs($moduleName);
	public function setSiteCacheDir();
	public function setSiteDir();
	public function getApplication();
	protected function setApplications();
	public function initConfiguration();
	public function checkLicense();
	public function initSiteConfiguration();
	public function getConfigPaths($configPath);
	public function addConfigDirectory($dir);
	public function addConfigDirectories($dirs);
	public function addConfigModulesDirectory($dir);
	public function addConfigModulesDirectories($dirs);
	public function getEnvironment();
	public function isDebug();
	public function getHelperDirs($moduleName=null);
	public function loadHelper($helperName, $module=null);
	public function  loadHelpers($helpers,$module=null);
	function loadModifier($modifierName,$module=null);
	public function  loadModifiers($modifiers,$module=null);
	function loadFunction($functionName, $module=null);
	public function loadFunctions($functions,$module=null);
	function initializeModules();
	public function checkLockAppEnv();
	public function checkLockSite();
	protected function hasLockFile($lockFile, $maxLockFileLifeTime = 0);
}
