<?php

class mfModuleInstall { 

	abstract function execute();
	function getModulePath();
	function getModelsPath();
	function getDataPath();
	function xcopy();
	public function install();
	public function uninstall();
	protected function isNotSuperAdmin();
}
