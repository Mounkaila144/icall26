<?php

class mfWebResponse { 

	function initialize($options=array());
	public function setHttpHeader($name, $value="", $replace = true);
	protected function normalizeHeaderName($name);
	public function getHttpHeader($name, $default = null);
	public function setContentType($value);
	protected function fixContentType($contentType);
	public function getHttpHeaders();
	public function clearHttpHeaders();
	public function removeCookie($name,$path='/',$domain = '', $secure = false, $httpOnly = false);
	public function setCookie($name, $value, $expire = null, $path = '/', $domain = '', $secure = false, $httpOnly = false);
	public function sendHttpHeaders();
	public function setHeaderFile($file,$with_name=false);
	public function sendFile($file,$time=2400,$cache=2);
	public function httpConditional($UnixTimeStamp,$cacheSeconds=0,$cachePrivacy=0);
	function setContent($content);
	public function setStatusCode($code, $name = null);
}
