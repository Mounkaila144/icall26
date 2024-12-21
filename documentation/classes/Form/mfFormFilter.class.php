<?php

class mfFormFilter { 

	protected function setFields($fields);
	function setQuery($query);
	function getQuery();
	protected function setClass($class);
	protected function getClass();
	protected function setHavingFields($fields);
	function setExcludeFields($exception_fields);
	protected function getTable();
	function toJson();
	protected function _getParametersForUrl($values);
	function _extractParametersForUrl($fields=array());
	function _extractParameterForUrl($name);
	function getParametersForUrl($fields=array());
	function setParameter($name,$value);
	function getParameter($name,$default);
	function getParameters();
	function setParameters($parameters);
	function injectParametersInQuery();
	function addObject($name);
	function addField($name,$conditions);
	function getFieldConditions();
}
