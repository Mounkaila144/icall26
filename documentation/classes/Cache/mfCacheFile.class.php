<?php

class mfCacheFile { 

	function __construct($name,$application=null,$site=null);
	function getName();
	protected function getApplication();
	function getSite();
	protected function getCacheFile();
	function isCached();
	function write($data);
	function read();
	function register($data);
	function remove();
	static function removeCache($name, $application = null, $site = null);
}
