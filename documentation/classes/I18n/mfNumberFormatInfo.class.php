<?php

class mfNumberFormatInfo { 

	function __get($name);
	function __set($name, $value);
	function __construct($data = array(), $type = mfNumberFormatInfo::DECIMAL);
	function setPattern($type = mfNumberFormatInfo::DECIMAL);
	function getPattern();
	static public function getInvariantInfo($type = mfNumberFormatInfo::DECIMAL);
	public static function getInstance($culture = null, $type = mfNumberFormatInfo::DECIMAL);
	public static function getCurrencyInstance($culture = null);
	public static function getPercentageInstance($culture = null);
	public static function getScientificInstance($culture = null);
	protected function parsePattern($pattern);
	protected function getPrePostfix($pattern);
	function getDecimalDigits();
	function setDecimalDigits($value);
	function getDigitSize();
	function setDigitSize($value);
	function getDecimalSeparator();
	function setDecimalSeparator($value);
	function getGroupSeparator();
	function setGroupSeparator($value);
	function getGroupSizes();
	function setGroupSizes($groupSize);
	function getNegativePattern();
	function setNegativePattern($pattern);
	function getPositivePattern();
	function setPositivePattern($pattern);
	function getCurrencySymbol($currency = 'USD');
	function setCurrencySymbol($symbol);
	function getNegativeInfinitySymbol();
	function setNegativeInfinitySymbol($value);
	function getPositiveInfinitySymbol();
	function setPositiveInfinitySymbol($value);
	function getNegativeSign();
	function setNegativeSign($value);
	function getPositiveSign();
	function setPositiveSign($value);
	function getNaNSymbol();
	function setNaNSymbol($value);
	function getPercentSymbol();
	function setPercentSymbol($value);
	function getPerMilleSymbol();
	function setPerMilleSymbol($value);
}
