<?php

class PictureObject2 { 

	function __construct($options);
	function Picture();
	function resize($newwidth, $newheight,$prefix="",$suffix="");
	protected function getPictureSize();
	function getHeight();
	function getWidth();
}
