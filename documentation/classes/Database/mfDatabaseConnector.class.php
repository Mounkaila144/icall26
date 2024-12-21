<?php

class mfDatabaseConnector { 

	public function getNumRows();
	public function fetchArray();
	public function getAffectedRows();
	public function fetchRow();
	public function getInsertId();
	public function fetchObject($class=null,$parameters=array());
	public function setObjects($objects);
	public function getObjects();
	public function setAlias($alias);
	protected function hasAlias($name);
	protected function getAlias($name);
	public function getObjectsFields();
	protected function _hasObject($name);
	public function hasClass($class);
	public function fetchObjects();
	protected function _fetchTreeObject($class);
	function fetchTreeObjects($class);
	function fetchTreeObject($class);
}
