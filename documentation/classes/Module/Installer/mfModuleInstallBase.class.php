<?php

class mfModuleInstallBase { 

	function __construct($module); //,$site=null);
	protected function configure();
	function getModule();
	function getSite();
	protected function getInstallPath();
	protected function getModuleInstallDirectory();
}
