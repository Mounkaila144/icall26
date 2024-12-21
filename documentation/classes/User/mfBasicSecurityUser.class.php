<?php

class mfBasicSecurityUser { 

	public function clearCredentials();
	public function getCredentials();
	public function removeCredential($credential);
	public function addCredential($credential);
	public function addCredentials();
	public function hasCredential($credentials, $useAnd = true);
	public function isAuthenticated();
	public function isAnonymous();
	public function getSessionExpired();
	public function setAuthenticated($authenticated);
	public function setTimeOut();
	public function isTimeOut();
	public function getLastRequestTime();
	public function initialize(mfStorage $storage, $options = array());
	public function shutdown();
}
