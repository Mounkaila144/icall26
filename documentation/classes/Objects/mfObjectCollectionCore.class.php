<?php

class mfCollectionCore { 

	function __construct($data=null);
	public function offsetExists($name);
	public function offsetGet($name);
	function getClass();
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function count();
	function reset();
	public function rewind();
	public function key();
	public function current();
	public function next();
	public function valid();
	function toArray($fields=array());
	function getCollectionKeys($fieldName=null);
	function getFirst();
	function isEmpty();
	function getKeys();
	function getLast();
}
