<?php

class pagerFiles { 

	function __construct($nb_items_by_page=10);
	function setNbItemsByPage($nb_items_by_page=10);
	function setFiles($files);
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
	function getBeginNumberResult();
	function getEndNumberResult();
	protected function getCount();
	function getFiles();
	function getItems();
	function execute();
	protected function rowstoObjects($offset=0);
	protected function removeFiles();
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
}
