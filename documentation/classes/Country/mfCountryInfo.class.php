<?php

class mfCountryInfo { 

	function __construct($country=null);
	public static function getInstance($country = 'en');
	function loadCountryInfo($country=null);
	function getStates();
	function hasState();
	static function _getZones();
	protected static function _getPoliticalZones();
	static function getCountries();
	static function getCountryCurrency();
	protected static function getCurrencyByZones();
	static function getZones($zones_requested=null);
	static function _getTranslatedZones($zones_requested=null,$method='_getZones',$culture=null);
	static function getTranslatedPoliticalZones($zones=null,$culture=null);
	static function getTranslatedZones($zones=null,$culture=null);
	static function getCurrenciesByPoliticalZones();
	static function getCurrencies();
	static function getCountrySupported();
	function getZone();
}
