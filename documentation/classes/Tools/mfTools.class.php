<?php

class mfTools { 

	public static function replaceConstants($value);
	public static function arrayDeepMerge();
	public static function stripslashesDeep($value);
	public static function generateUniqueId();
	function generatePassword($length = 8);
	public static function generatePassword($length = 8, $type = 'ALPHANUMERIC');
	static public function I18N_toEncoding($string, $to);
	static public function I18N_noaccent($string);
	static public function isWindowsServer();
	static public function isLinuxServer();
	static public function textWithVariables($body);
}
