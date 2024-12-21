<?php

class mfPhoneInfo { 

	function __construct();
	public static function getInstance();
	function loadPhoneInfo();
	function getCountryFromCode($code,$default=null);
	function getCountryFromPhone($phone,$lower=false,$default=null);
	function getCountryByCodeAndLength($code,$length=1);
}
