<?php

class mfSessionStorage { 

	public function initialize($options = null);
	public function read($key,$default=null);
	public function remove($key);
	public function has($key);
	public function write($key, $data);
	public function regenerate($destroy = false);
	public function shutdown();
	public function removeAll();
}
