<?php

class mfUserAgent { 

	static public function getInstance($userAgent=NULL);
	function __construct($userAgent=NULL);
	function getString();
	function getBrowser();
	function getBrowserName();
	function getBrowserVersion();
	function getOS();
	private function _getBrowser();
	private function _getOS();
	public function match($regex, $userAgent = null);
	public function isTablet();
	function isMobile();
}
