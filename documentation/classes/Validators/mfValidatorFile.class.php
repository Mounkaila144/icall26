<?php

class mfValidatorFile { 

	protected function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	protected function validatedFile($name,$mime,$tmp_name,$size,$path,$filename);	
	protected function getMimeType($file, $fallback);
	protected function guessFromFileinfo($file);
	protected function guessFromMimeContentType($file);
	protected function guessFromFileBinary();
	protected function getMimeTypesFromCategory($category);
	protected function isEmpty($value);
	function getExtensions();
}
