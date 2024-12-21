<?php

class mfMySQLDatabase { 

	function connect();
	protected function getConnectMethod($persistent);
	public function selectDatabase();
	public function shutdown();
	public function setResultResource($result);
	public function getResult();
	public function executeQuery($query);
	public function getNumRows();
	public function getErrorNo();
	public function getError();
	public function escape($value);
	public function fetchObject($object=null,$parameters=array());
	public function fetchArray();
	public function getAffectedRows();
	public function getInsertId();
	public function fetchRow();
	public function ping();
	protected function checkConnection();
}
