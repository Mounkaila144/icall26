<?php

class mfDateTimeFormatInfo { 
	function __get($name);
	function __set($name, $value);
	function __construct($data = array());
	protected function getData();
	static function getInstance($culture = null);
	function getAbbreviatedDayNames();
	function setAbbreviatedDayNames($value);
	function getNarrowDayNames();
	function setNarrowDayNames($value);
	function getDayNames();
	function setDayNames($value);
	function getNarrowMonthNames();
	function setNarrowMonthNames($value);
	function getAbbreviatedMonthNames();
	function setAbbreviatedMonthNames($value);
	function getMonthNames();
	function setMonthNames($value);
	function getEra($era);
	function getAMDesignator();
	function setAMDesignator($value);
	function getPMDesignator();
	function setPMDesignator($value);
	function getAMPMMarkers();
	function setAMPMMarkers($value);
	function getFullTimePattern();
	function getLongTimePattern();
	function getMediumTimePattern();
	function getShortTimePattern();
	function getFullDatePattern();
	function getLongDatePattern();
	function getMediumDatePattern();
	function getShortDatePattern();
	function getDateTimeOrderPattern();
	function formatDateTime($date, $time);
	function getLargeDatePattern();
	function getDateFormats();
}
