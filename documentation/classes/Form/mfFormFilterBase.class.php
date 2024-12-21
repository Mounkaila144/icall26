<?php

class mfFormFilterBase { 

	protected function findFieldClass($fieldName);
	protected function checkClass($class,$fieldName);
	protected function clearParameters();
	protected function hasHavingParameters();
	protected function hasWhereParameters();
	protected function setFieldNameAndValueParameter($mode,$fieldName,$operation,$value="");
	protected function getHavingParameters($remove=0);
	protected function getWhereParameters($remove=0);
	protected function getFieldNameAndValue($mode,$fieldName,$operation,$value="");
	protected function getFieldName($operation,$fieldName);
	protected function buildOrderQuery($values);
	protected function buildSearchQuery($values);
	protected function buildComparaisonQuery($values);
	protected function buildRangeQuery($values);
	protected function buildEqualQuery($values);
	protected function buildInQuery($values);
	protected function buildBeginQuery($values);
	protected function insertParametersInQuery($op=" AND ",$begin="",$end="",$last_remove=0);
	protected function replaceHavingParameters($query);
	protected function replaceWhereParameters($value);
	protected function getFunctionsQuery();
	protected function _getQuery();
	function getQuery();
	function escape($str);
	function getWhere($operation="");
	function getHaving();
}
