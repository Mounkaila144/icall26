<?php

class orderedObjectCollection { 

	abstract protected function executeSelectNodesQuery($db);
	abstract protected function executeShiftQuery($db,$min,$max);
	protected function configure();
	protected function _getLastPosition();
	protected function isPositionRequired();
	protected function createPosition();
	protected function insert();
	abstract protected function executeLastPositionQuery($db);
	abstract protected function executeUpdatePositionQuery($position,$db);
	protected function getLowerPosition();
	protected function findNodePosition($data,$positionToFind="min");
	function delete();
	protected function updatePositionCollection($position);
	protected function getWhereNodesConditions();
	protected function getKeyNodesForWhereFromArray();
	function moveTo($nodes);
	protected function ObjectsToNodes($db);
	protected function _moveIfRequired();
	function update();
	protected function getLastPositionByKeys($name,$keys);
}
