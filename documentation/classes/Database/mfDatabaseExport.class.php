<?php

class mfDatabaseExport { 

	abstract protected function outputLine($row);
	function __construct($class,$application=null,$site=null);
    protected function getDefaultFields();
	protected function getClass();
	protected function getTable();
	function setParameters($parameters);
	function setQuery($query);
	function setFields($fields);
	function getFields();
	protected function configure();
	protected function setApplicationAndSite($application,$site);
	protected function rowsToObjects($db);
	protected function getObject();
	protected function _getFieldsArray();
	protected function _getFields();
	public function hasFields();
	protected function findObjects();
	protected function getObjects();
	protected function hasObjects();
	protected function execute();
	protected function getApplication();
	function getSiteName();
	function getSite();
}
