<?php

class mfAutoloadModule { 

	protected function __construct();
	function addModule($module);
	static public function getInstance();
	public function register();
	public function unregister();
	public function autoload($class);
	public function getClassPath($class);
}
