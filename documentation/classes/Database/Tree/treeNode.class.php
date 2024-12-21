<?php

class treeNode { 
    
        protected static $foreignKeyMethods=array( );
        protected static $fieldsType=array();
        
	function __construct($parameters=null,$application=null,$site=null);
	static function getFields();
	function getRoot();
	protected function _getRoot();
	protected function getRootDefaults();
	protected function createRoot();
	protected function loadByName($name);
	protected function executeLoadById($db);
	protected function executeInsertQuery($db);
	function asFirstChild();
	function asLastChild();
	function asPrevSibling();
	function asNextSibling();
	function at($node);
	function getNode();
	protected function _getNode();
	protected function _insertFirstChild();
	protected function _insertLastChild();
	protected function _insertPrevSibling();
	protected function _insertNextSibling();
	protected function getDefaults();
	protected function _insert($db);
	function getValuesForUpdate();
	protected function executeUpdateQuery($db);
	protected function executeDeleteQuery($db);
	protected function remove();
	protected function _shiftBorder($boundary,$variation,$shift);
	protected function loadNode();
	function moveTo($node);
	protected function _moveIfRequired();
	protected function update();
	protected function _moveToFirstChild();
	protected function _moveToLastChild();
	protected function _moveToPrevSibling();
	protected function _moveToNextSibling();
	protected function _move($to,$levelDiff);
	function _shiftBorderRange($first,$last,$levelDiff,$variation,$shift);
	function isRoot();
	function nodeHasChildren();
	function isLeaf();
	function length();
	protected function loadNodeWhere($mode,$sign,$value);
	function isExist();
	function getFather();
	function getNextSibling();
	function getPreviousSibling();
}
