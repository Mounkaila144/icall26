<?php

class GPSBearing { 

	function __construct(GPSCoordinate $pos1,GPSCoordinate $pos2);
	static function getDirections();
	protected function calculation();
	function getBearing();
	function getAngle();
	function getCompass();
	function __toString();
}
