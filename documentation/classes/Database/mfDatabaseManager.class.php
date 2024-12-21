<?php

class mfDatabaseManager { 

	function __construct($configuration, $options=array());
	protected function getCacheFile($name);
	public function setDatabase($name, mfDatabase $database);
	public function removeDatabase($name);
	public function selectDatabase($name);
	public function connect($name);
	public function shutdown();
	protected function getCacheDatabase($name);
	public function writeCache($data);
	static function removeCache($name);
	public function registerDatabase($name,$parameters);
}
