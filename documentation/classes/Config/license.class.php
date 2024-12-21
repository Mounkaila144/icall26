<?php

class license { 
	function __construct();
	function isValid();
	static function getSignature();
	function checkSignature($signature);
	static function getDateExpiration();
	static function getVersion();
	static function getVersionDate();
}
