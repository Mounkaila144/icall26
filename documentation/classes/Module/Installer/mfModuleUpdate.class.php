<?php

class mfModuleUpdate { 

	function __construct($module,$version);
	function configure();
	function getUpdateDirectory();
	function getVersion();
	function getModelsPath();
	protected function getInstallPath();
	abstract function execute();
}
