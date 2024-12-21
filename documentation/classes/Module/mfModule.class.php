<?php

class mfModule { 

	function __construct($name,$site=null);
	protected function setInSite();
	protected function getModuleSitePath();
	protected function getModuleCorePath();
	protected function getConfigFilePath();
	function getModulePath();
	function hasConfigFile();
	function hasNotConfigFile();
	function getConfig();
	protected function loadConfigFromFile();
	protected function checkIfInstalled();
	function isInstalled();
	public function isNotInstalled();
	public function removeConfigCache();
	public function getLogo();
	function getAvailableTypes();
	function isUninstallable();
	function getInstaller();
	function setInstallerClass($class);
	function isCore();
	function isSuperAdmin();
	static function getInstance($name,$site=null);
	static function isModuleInstalled($name,$site=null);
	function __toString();
	function isUptoDate();
	function getActionDirectory($application);
	function getInstallDirectory();
	function getDependenciesFile();
}
