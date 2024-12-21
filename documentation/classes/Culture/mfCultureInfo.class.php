<?php

class mfCultureInfo { 

	function __construct($culture=null);
	public static function getInstance($culture = 'en');
	protected static function cleanCulture($culture);
	function loadCulture($culture=null);
	protected function setCulture($culture);
	protected function getCulture();
	protected function getData($filename);
	function &__get($name);
	function getCountries();
	function getCountry($code);
	function getLanguage($code);
	function getPostalCode();
	function getPhoneFormat();
	function getState($country);
	function getZones();
	function getPostalCodePattern();
	function has($name);
	function get($name);
	public function getInfo($info);
	public function getNumberFormat();
	public function setNumberFormat($numberFormat);
	public function getCompanyRegistration($value='validators',$default=null);
	public function getFilesize();
	public function getGender();
	public function getCourtesy();
	function findInfo($path = '/', $merge = false);
	private function array_add($array1, $array2);
	protected function searchArray($info, $path = '/');
	public function getCurrencies($currencies = null, $full = false);
	public function getCurrencySymbol($code);
	public function getCurrencyText($code);
	public function sortArray(&$array);
	public function getDateTimeFormat();
	public function setDateTimeFormat($dateTimeFormat);
	public function getCalendar();
	public function getStates();
	public function getCultures();
	static function getCultureSupported();
}
