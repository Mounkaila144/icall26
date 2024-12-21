<?php

class siteModulesCore { 

	abstract function update();
	abstract function isUptodate();
	abstract protected function getInstalledModulesForSite();
	abstract protected function configure();
	function __construct(Site $site);
	function getSite();
	public function getModules();
	public function getModulesUpdated();
	public function hasModulesUpdated();
}
