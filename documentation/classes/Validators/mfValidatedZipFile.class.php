<?php

class mfValidatedZipFile { 

	public function __construct($originalName, $type, $tempName, $size, $path = null,$filename=null);
	public function save($path=null,$file = null, $fileMode = 0666, $create = true, $dirMode = 0777);
	public function getTempName();
	public function generateFilename();
	public function getExtension($default = '');
	public function getOriginalExtension($default = '');
	public function getOriginalName();
	public function getOriginalFilename();
	public function setFilename($filename);
	public function getFilename();
	public function getSavedFile();
	public function getFile();
	public function getPath();
	public function setPath($path);
	public function __toString();
}
