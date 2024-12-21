<?php

class mfObjectCollection2 { 

	 
	function initialize();
	protected function _loadObjects();
	protected function getKeyForSelect();
	protected function getIndexFromData($data,$item);
	protected function ObjectsToCollection($db);
	protected function _getCollectionToLoad();
	protected function isKeysEqual($value,$item);
	protected function keysExist($item);
	protected function loadCollection();
	protected function _updateCollection();
	protected function getFieldsForWhereFromObject();
	protected function _getFieldsForWhereFromArray();
	protected function organizeCollectionForSelect($key);
	protected function getKeyForWhereFromArray();
	protected function getKeyForWhereFromObject();
	protected function getKeysForWhereFromArray();
	protected function getFieldsForWhereFromArray();
	protected function getWhereConditions();
	protected function buildParameters();
	protected function getNewObject();
	protected function hasNewObject();
	protected function insert();
	protected function _insert();
	protected function _updateObjectsInserted($id);
	protected function getFieldsForInsert();
	protected function getParametersForInsert();
	protected function getUpdatedObject();
	protected function hasUpdatedObject();
	protected function checkPropertiesChanged();
	protected function updateObjects();
	protected function _update();
	protected function update();
	protected function getParametersForUpdate();
	protected function getFieldsForUpdate();
	protected function updateOrInsert();
        function removeByKeys($keys);
        function removeByKey($key);
	function save();
	function delete();
	 
}
