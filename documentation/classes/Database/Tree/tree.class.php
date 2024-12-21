<?php

class tree { 

	function __construct($application=null,$site=null);
	abstract protected function executeLoad($db);
	protected function getClass();
	protected function configure();
	function getSite();
	protected function setClass($class);
	function setWidth($width);
	function getQuery();
	function setQuery($query);
	function from($father);
	function setParameter($name,$value);
	function addParameters($parameters);
	protected function replaceWhereParameters($value);
	protected function replaceOrderParameters();
	protected function executeQuery($db);
	protected function getRow($db);
	protected function rowsToTree($db);
	function load();
	function getTree();
}
