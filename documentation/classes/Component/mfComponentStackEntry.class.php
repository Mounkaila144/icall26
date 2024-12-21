<?php

class mfComponentStackEntry { 

	public function __construct($moduleName,$blockName=null,$instance=null);
	public function getBlockName();
	public function getModuleName();
	public function getComponentName($separator='/');
	public function getComponentInstance();
}
