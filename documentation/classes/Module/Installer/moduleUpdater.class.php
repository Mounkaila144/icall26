<?php

class moduleUpdater { 

	static function getInstance($module,Site $site=null);
	function configure();
	function isUpToDate();
	protected function getModuleVersions();
	protected function getSiteVersions();
	protected function _getVersions($path);
	function getVersionsToUpdate();
	function getSiteLastVersion();
	protected function writeReport($version="");
	function install();
	function upGrade();
	function getVersionsUpgraded();
	function getVersionsDowngraded();
	function isUpgraded();
	function isDowngraded();
	function downGrade($step=1);
	protected function upGradeModule($version);
	protected function downGradeModule($version);
	protected function loadAction($type,$version="");
}
