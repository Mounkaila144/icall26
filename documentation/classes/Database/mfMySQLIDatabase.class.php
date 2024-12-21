<?php

class mfMYSQLIDatabase { 

	function connect();
	protected function getConnectMethod();
	public function selectDatabase();
	public function shutdown();
	public function setResultResource($result);
	public function getResult();
	public function executeQuery($query);
	public function getNumRows();
	public function getErrorNo();
	public function getError();
	public function escape($value);
	public function fetchObject($object="");
	public function fetchArray();
	public function getAffectedRows();
	public function getInsertId();
	public function fetchRow();
}
