<?php

class mfMailer { 

	public function __construct($options);
	static public function initialize();
	public function compose($from = null, $to = null, $subject = null, $body = null);
	public function debug($debug=true);
	public function sendMail($moduleName,$actionName,$from,$to,$subject,$parameters=array(),$files=array());
	public function sendMailContent($from,$to,$subject,$content);
	function getContent();
}
