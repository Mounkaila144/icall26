<?php

class mfRoutings { 

	function __construct($options=array(),$request=null);
	protected function initialize();
	protected function getOption($name,$default=null);
	protected function loadRoutes();
	protected function getRequest();
	function parse($url);
	function getRouteModuleAction($name,$parameters=array());
	function getRoute($name,$parameters=array());
	function shutdown();
	function get($name);
	function getRouteFromUrl($url);
}
