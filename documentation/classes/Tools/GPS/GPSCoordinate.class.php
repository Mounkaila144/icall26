<?php

class GPSCoordinate { 

	function __construct($latitude,$longitude=0.0);
	function get($separator=',');
	function getUrlEncode($separator=',');
	function __toString();
	function getLatitude();
	function getLongitude();
	function getLonLat($encode=false,$separator='/');
	function getLatLon($encode=false,$separator='/');
	function getLatDMS();
	function getLngDMS();
	function getCoordinateFromDistanceAndBearing($d,$angle);
	function toArray();
	function toJson();
	function getFormattedCoordinates();
	function createBox($l,$h);
}
