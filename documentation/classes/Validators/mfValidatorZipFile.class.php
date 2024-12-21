<?php

class mfValidatorZipFile { 

	protected function configure($options = array(), $messages = array());
	protected function getMimeType($file, $fallback);
	protected function validatedFile($name,$mime,$tmp_name,$size,$path,$filename);
}
