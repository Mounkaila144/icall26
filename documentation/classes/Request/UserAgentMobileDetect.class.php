<?php

class UserAgentMobileDetect { 

	public static function getScriptVersion();
	public function setHttpHeaders($httpHeaders = null);
	public function getHttpHeaders();
	public function getHttpHeader($header);
	public function setUserAgent($userAgent = null);
	public function getUserAgent();
	public function setDetectionType($type = null);
	public static function getPhoneDevices();
	public static function getTabletDevices();
	public static function getUserAgents();
	public static function getBrowsers();
	public static function getUtilities();
	public static function getMobileDetectionRules();
	public function getMobileDetectionRulesExtended();
	public function getRules();
	public function checkHttpHeadersForMobile();
	public function __call($name, $arguments);
	private function matchDetectionRulesAgainstUA($userAgent = null);
	private function matchUAAgainstKey($key, $userAgent = null);
	public function isMobile($userAgent = null, $httpHeaders = null);
	public function isTablet($userAgent = null, $httpHeaders = null);
	public function is($key, $userAgent = null, $httpHeaders = null);
	public static function getOperatingSystems();
	public function match($regex, $userAgent = null);
	public static function getProperties();
	public function prepareVersionNo($ver);
	public function version($propertyName, $type = self::VERSION_TYPE_STRING);
	public function mobileGrade();
}
