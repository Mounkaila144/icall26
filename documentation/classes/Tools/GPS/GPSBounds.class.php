<?php

class GPSBounds { 

	function __construct($pos_north_east,$pos_south_west);
	protected function calculate();
	function getBounds();
	function toArray();
	function toJson();
	function getNorth();
	function getWest();
	function getSouth();
	function getEast();
}
