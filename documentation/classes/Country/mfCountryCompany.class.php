<?php

class mfCountryCompany { 

	function __construct($country=null);
	public static function getInstance($country = 'en');
	function loadCountryCompany($country=null);
	function getRegistration($value="validators",$default=null);
	static function getCountrySupported();
	function getRegistrationForDisplay($fields=array());
}
