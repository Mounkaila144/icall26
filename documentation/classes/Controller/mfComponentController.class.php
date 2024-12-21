<?php

class mfComponentController { 

	function __construct($context);
	public function initialize($context);
	public function configure();
	public function setRenderMode($mode);
	public function getRenderMode();
	protected function getContext();
}
