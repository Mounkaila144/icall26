<?php

class mfSiteDatabase { 

	public static function getInstance();
	function __construct();
	protected function initialize();
	public function setParameters($parameters=array(), $application=null, $site=null);
	public function setParameter($key,$value);
	public function addParameter($parameter);
	public function addParameters($parameters);
	public function getParameters();
	public function setQuery($query);
	public function getQuery();
	public function setSite($site=null);
	public function setApplication($application=null);
	protected function injectObjectsFields();
	protected function insertApplicationInQuery();
	protected function replaceParametersInQuery();
	function escape($value);
	protected function formatAndProtectRequest();
	function checkApplicationAccess();
	protected function checkSiteAccess();
	protected function setApplicationAndSite($application,$site=null);
	public function makeSqlQuery($application=null,$site=null);
	public function makeSiteSqlQuery($site=null);
	public function isDatabaseExist($site=null);
	public function createDatabase(Site $site);
	public function dropDatabase(Site $site);
	function getSuperAdminDatabase();
	public function execute($select_db=true);
	public function makeSqlQuerySuperAdmin($application=null);
	public function getResource();
	public function getLink();
	protected function traceStart();
	public function isErrorExist();
	protected function clearError();
	protected function setErrorSQL();
	protected function traceStop();
	static function getCountQuery();
	protected function printApplicationForced();
	public function getDatabase();
	public function getSize(Site $site);
	public function registerDatabase($name,$parameters);
	public function makeSqlQueryForDatabase($name);
}
