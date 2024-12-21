<?php

class ConditionsQuery { 

	function __construct($where="",$parameters=array());
	function setWhere($where,$operator="AND");
	function add($where,$operation=" ");
	function getWhere($where="WHERE");
	function setParameters($parameters);
	function addParameters($parameters);
	function getParameters($parameters=array());
	function debug();
}
class mfDatabase { 

	public function __construct($parameters = array());
	public function initialize($parameters = array());
	abstract function connect();
	abstract protected function checkConnection();
	public function getConnection();
	public function getResource();
	public function getParameters();
	public function getParameter($name, $default = null);
	public function hasParameter($name);
	public function setParameter($name, $value);
	abstract function shutdown();
	abstract function executeQuery($query);
	abstract function getNumRows();
	abstract function getErrorNo();
	abstract function getError();
	abstract function escape($value);
	abstract function fetchObject($object=null,$parameters=array());
	abstract function fetchArray();
	abstract function getAffectedRows();
	abstract function getInsertId();
}
