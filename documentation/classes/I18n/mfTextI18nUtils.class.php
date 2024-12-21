<?php

class mfTextI18nUtils { 

	function __construct($name=null);
	function setModule($module);
	protected function openOutputFile();
	protected function closeOutputFile();
	protected function escape($value);
	protected function outputLine($text,$application,$theme,$template,$block=false);
	protected function parseFile($template,$application,$theme,$block=false);
	protected function findTemplates();
	function findActions();
	static function findAll();
	function find();
}
