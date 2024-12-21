<?php

class mfMessages { 

	function __construct();
	static function getInstance();
	public function addMessage($type,$error);
	public function addMessages($type,$errors);
	public function addInfo($message);
	public function addError($message);
	public function addWarning($message);
	public function addErrors($messages);
	public function deleteErrors();
	public function &getErrors();
	public function &getMessages();
	public function hasErrors();
	public function hasWarnings();
	public function hasMessages($type=null);
	public function getDecodedMessages($type=null);
	public function getDecodedErrors();
	public function getDecodedInfos();
	public function merge($messages);
	public function mergeMessages(mfMessages $message);
}
