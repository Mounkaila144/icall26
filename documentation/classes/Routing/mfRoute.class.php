<?php

class mfRoute { 

	function __construct($route);
	protected function prepareVariables($parameters);
	protected function compileAndCleanRequirements();
	function getRoute($parameters);
	protected function compileRequirements();
	function isValid($value);
	protected function _getModule();
	protected function _getAction();
	protected function compileParameters();
	function getParameters();
	function getParameter($name);
	function getModule();
	function getAction();
	function getMethod();
	function getRouteModuleAction($parameters=array());
	function serialize();
	function getMatches();
	function getMatche($name);
	function setName($name);
	function getName();
	function getRouteParameters();
	function isEqual($route);
	function getPattern();
	function getType();
	function hasType();
	function isI18n();
	function getRouteWithParameters();
}
