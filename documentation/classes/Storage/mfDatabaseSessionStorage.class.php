<?php

class mfDatabaseSessionStorage { 

	function initialize($options=array());
	public function sessionClose();
	public function sessionOpen($path = null, $name = null);
	public function sessionDestroy($id);
	public function sessionGC($lifetime);
	public function sessionRead($id);
	public function sessionWrite($id, $data);
	public function shutdown();
}
