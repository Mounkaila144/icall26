<?php

class mfFilesFormFilter { 

	function __construct($directory="",$defaults = array(),$options=array());
	protected function setExceptions($exceptions);
	protected function setClass($class);
	protected function setDirectory($dir);
	protected function getDirectory();
	protected function setQuery($query);
	protected function getQuery();
	protected function isNotException($file);
	protected function newObject($file);
	protected function _getFiles();
	protected function getFunctionsQuery();
	function getFiles();
	protected function buildOrderQuery($values);
	protected function cmpTime($file1,$file2);
	protected function cmpName($file1,$file2);
	protected function cmpExtension($file1,$file2);
	protected function cmpSize($file1,$file2);
	protected function buildRangeQuery($values);
	protected function buildRangeTime($range);
	protected function _updateMinMaxFields();
	function getFileTimeMax();
	function getFileTimeMin();
	protected function getParameters();
}
