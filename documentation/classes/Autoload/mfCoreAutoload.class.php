<?php

class mfCoreAutoload { 

	function __construct();
	static public function getInstance();
	static public function register();
	static public function unregister();
	public function autoload($class);
	function loadClassesSite();
	public function reloadClassesSite();
	public function loadClasses();
	public function reloadClasses();
	public function loadClass($class);
	public function addClasses($classes);
	function getClasses();
	function loadClassesCore();
	function debug();
}
