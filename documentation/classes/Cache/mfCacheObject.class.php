<?php

class mfCacheObject { 

	function __construct($name_space,$key,$application=null,$site=null);
	function getNameSpace();
	function getKey();
	protected function getApplication();
	function getSite();
	protected function getCacheDirectory();
	static function getPath($name_space,$application,$site);
	protected function getCacheFile();
	function isCached();
	function write($object);
	function read();
	function register($data);
	function remove();
}
