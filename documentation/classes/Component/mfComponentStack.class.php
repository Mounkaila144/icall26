<?php

class mfComponentStack { 

	public function addEntry($moduleName,$blockName=null,$instance=null);
	public function getEntry($index);
	public function popEntry();
	public function getFirstEntry();
	public function getLastEntry();
	public function getSize();
}
