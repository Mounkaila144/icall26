<?php

class mfLayoutXML { 

	function __construct($options=array());
	protected function getCompiledFilename();
	function getLayout();
	function getBlocks($blocks,&$data);
	function getReferences($references,&$data);
	protected function templateExists($filename);
	protected function save($data);
}
