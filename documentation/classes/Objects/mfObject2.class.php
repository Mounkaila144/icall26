<?php

class mfObject2 {

    protected static $fields=array(); // By default
    protected static $fieldsNull=array(); // By default
    protected static $foreignKeys=array(); // By default
    protected static $foreignKeyMethods=array();
    protected static $fieldsType=array();

	abstract protected function executeDeleteQuery($db);
	abstract protected function executeInsertQuery($db);
	abstract protected function executeUpdateQuery($db);
	protected function executeLoadById($db);
	protected function executeIsExistQuery($db);
	protected function initialize();
	static function getFields();
	static function hasField($name);
	static function getKeys();
	static function getForeignKeys();
	static function getForeignKey($class);
	static function getForeignKeyWithTableForJoinInner($class);
	static function getForeignKeyWithTableForJoinOuter($class);
	static function getForeignClass($fieldName);
	static function getOuterForJoin($fieldName,$alias="",$foreign_alias="");
	static function getInnerForJoin($fieldName,$alias="",$foreign_alias="");
	static function getFieldsNull();
	static function getKeyName();
	static function getTableKey($alias="");
	static function getFieldsAndKey();
	static function getFieldsWithTable($alias="");
	static function getFieldsAndKeyWithTable($alias="");
	static function getTable($alias="");
	static function getTableField($name,$alias="");
	static function getTableFields($fields);
	function getFieldsForUpdate();
	function getParametersForUpdate();
	protected function isForeignKeyExists($name);
	function set($name,$value);
	function isLoaded();
	function isNotLoaded();
	function loaded();
	function noPropertyChanged();
	function notLoaded();
	protected function rowtoObject($db);
	protected function loadById($id);
	protected function remove();
	function delete();
	public function save();
	function isExist();
	function isNotUnique();
	protected function insert();
	protected function update();
	function getValuesForUpdate();
	function getKey();
	protected function getDefaults();
	function _setDefaults();
	protected function hasPropertiesChanged($fields=array());
	public function hasPropertyChanged($name);
	public function getPropertyChanged($name);
	public function getPropertiesChanged();
	function getFieldNamesForQuery();
	function getParametersForInsert();
	function getFieldsForInsert();
	function escape($str);
	function isEmpty();
	function isNotEmpty();
	function toArray($fields=null);
	function get($name,$default=null);
	protected function getWhereKeysCondition();
	protected function getWhereKeysParameters();
	protected function toObject($object);
	protected function getLoaded();
	function copyFrom($object,$exxcepted=array(),$fields=array(),$adders=array());
	function copy();
	function getNextId();
	static function truncate($site=null);
	function getChanges();
	static function getTableEscape($alias=null);
	static function getTableFieldEscape($name,$alias="");
	static function lock();
	static function unlock();
}
