<?php

class orderedObject extends mfObject2 { 

	abstract protected function executeLastPositionQuery($db);
	abstract protected function executeShiftUpQuery($db);
	abstract protected function executeShiftDownQuery($db);
	abstract protected function executeShiftQuery($db);
	abstract protected function executeSiblingQuery($db);
	function configure();
	function getNode();
	function moveTo($node);
	protected function _getLastPosition();
	protected function insert();
	protected function _moveIfRequired();
	protected function _shiftDown($current,$node);
	protected function _shiftUp($current,$node);
	protected function _shift($current);
	function update();
	protected function remove();
	protected function _getSibling($position);
	function moveToLast();
	function moveToFirst();
	function moveToNext();
	function moveToPrevious();
	function getFirstSibling();
	function getNextSibling();
	function getLastSibling();
	function getPreviousSibling();
	function isLast();
	function isFirst();
}
