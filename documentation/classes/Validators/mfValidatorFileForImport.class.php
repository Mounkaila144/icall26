<?php

class mfValidatorFileForImport { 

	protected function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	protected function validatedFile($name,$mime,$tmp_name,$size,$path,$filename);
	protected function isEmpty($value);
}
