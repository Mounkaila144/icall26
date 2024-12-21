<?php

class mfNumberFormat { 

	function __construct($formatInfo = null);
	function format($number, $pattern = 'd', $currency = 'USD', $charset = 'UTF-8');
	protected function formatInteger($string);
	protected function formatDecimal($string);
	protected function setPattern($pattern);
	protected function fixFloat($float);
}
