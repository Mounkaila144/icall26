<?php

class siteModulesBase { 

	protected function configure();
	function getCoreModules();
	protected function findCoreModules();
	function update();
	function getModulesToUpdate();
	function isUptodate();
	protected function getInstalledModulesForSite();
	public function getModules();
	public function getModulesUpdated();
	public function hasModulesUpdated();
}
