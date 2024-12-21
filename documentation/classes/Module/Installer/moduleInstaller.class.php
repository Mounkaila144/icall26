<?php

class moduleInstaller { 

	function __construct(mfModule $module);
	public function setOptions($options);
	public function getOptions();
	public function setOption($name,$value);
	public function hasOption($name);
	public function getOption($name,$default=null);
	protected function getInstallPath();
	protected function configure();
	function getModule();
	protected function getSource();
	function isAuthorized();
	function isNotAuthorized();
	public function install();
	function uninstall();
	protected function delete();
	protected function getInstallerFile();
	function hasInstaller();
	protected function getUninstallerFile();
	function hasUninstaller();
	protected function loadAction($action='install');
	protected function writeReport();
	protected function addDependencies(&$dependencies,$modules);
	function buildDependencies();
	function installDependencies();
	protected function addError($message);
	function hasErrors();
	function getErrors();
	function addMessage($message);
	function hasLogReport();
	function getLogReport();
	function setLogReport($report);
	function hasDependencies();
	function hasDependenciesInstalled();
	function isUptoDate();
	function getDependencies();
}
