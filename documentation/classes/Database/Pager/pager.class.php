<?php

class Pager { 

	function __construct($class,$nb_items_by_page=10);
	function setNbItemsByPage($nb_items_by_page=10);
	function setQuery($query,$parameters=array());
	function setParameters($parameters=array());
	function addParameters($parameters);
	function setParameter($name,$value);
	function getParameter($name,$default=null);
	function setPage($page_requested);
	function getNbItemsByPage();
	function getResults();
	function getClass();
	function getNextPage();
	function getLastPage();
	function getPreviousPage();
	function getFirstPage();
	function haveToPaginate();
	function getPages();
	function getPage();
	function getNbItems();
	function hasItems();
	function getBeginNumberResult();
	function getEndNumberResult();
	protected function getCountQuery();
	protected function _getCount();
	function setQueryForCount($query);
	protected function setApplicationAndSite($application,$site);
	protected function setMethod($method=null);
	function getItems();
	protected function getCount();
	protected function prepareQuery();
	function execute($application=null,$site=null);
	protected function fetchObjects($db);
	protected function fetchObject($db);
	protected function rowsToObjects($db);
	protected function insertFieldsInQuery($db);
	function executeSite($site=null,$application=null);
	function executeSuperAdmin();
	function executeFromDatabase($db_name);
	function getFirstItem();
	function getSite();
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function offsetExists($name);
	public function offsetGet($name);
	public function count();
	public function rewind();
	public function key();
	public function current();
	public function next();
	public function valid();
	public function toArray($fields=null);
	public function JSON($fields=null);
	function getQuery();
	function getQueryEscape();
	function getQueryWithLimit();
	function getQueryForDebug();
	function setAlias($alias);
	function getAlias();
	function isExecuted();
	function isEmpty();
	function getParameters();
	function getKeys();
	function getLastItem();
	function setSite($site);
}
