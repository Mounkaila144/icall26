<?php

class mfObjectCollectionBase { 

	function __construct($data=null,$application=null,$site=null);
	protected function configure();
	protected function getFields();
	protected function getFieldNamesForQuery();
	protected function getTable();
	function getApplication();
	function getSiteName();
	function getSiteHost();
	function getSite();
	protected function setApplicationAndSite($application,$site);
	function setParameters($parameters);
	function getClass();
	function setClass($class);
	protected function getClassKey();
	protected function getClassKeys();
	protected function getTableKey();
	function isLoaded();
	function isNotLoaded();
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function count();
	public function rewind();
	public function key();
	public function current();
	public function next();
	public function valid();
	public function loaded();
	function toArray($fields=array());
	function getCollectionKeys($fieldName=null);
	function getFirst();
	function isEmpty();
	function getKeys();
	function getLast();
}
