<?php

class GPSBoxCoordinates { 

	function __construct(GPSCoordinate $pos,$distance_l,$distance_h=0);
	function getBoundingBox();
	function getSquareBoundingBox();
	function getNorthWest();
	function getNorthEast();
	function getSouthEast();
	function getSouthWest();
	function getBounds();
}
