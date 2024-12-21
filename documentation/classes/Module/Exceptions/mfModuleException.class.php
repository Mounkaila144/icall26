<?php

class mfModuleException { 

	function __construct($code,$parameters=array());
	function getParameters();
	function get($name,$default=null);
	function getFormattedMessage();
	function getI18nMessage();
}
