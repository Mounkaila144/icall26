<?php

class mfObjectBase { 

	function __construct($application=null,$site=null);
	protected function setApplicationAndSite($application=null,$site=null);
	function getSite();
	protected function getApplication();
	function getSiteName();
	protected function configure();
	function str_escape($value);
	function setSite($site);
}
