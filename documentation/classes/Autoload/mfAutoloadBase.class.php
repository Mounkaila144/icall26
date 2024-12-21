<?php

class mfAutoloadBase { 

	public function register();
	public function unregister();
	public function autoload($class);
	public function getClassPath($class);
}
