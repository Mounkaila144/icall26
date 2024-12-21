<?php

class mfEventDispatcher { 

	function __construct($context);
	public function connect($name, $listener);
	public function disconnect($name, $listener);
	public function notify(mfEvent $event);
	public function notifyUntil(mfEvent $event);
	public function filter(sfEvent $event, $value);
	public function hasListeners($name);
	public function getListeners($name);
}
