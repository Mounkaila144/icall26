<?php

class mfDateFormat { 
	function __construct($formatInfo = null);
	public function getDate($time, $pattern = null);
	public function format($time, $pattern = 'F', $inputPattern = null, $charset = 'UTF-8');
	protected function getFunctionName($token);
	public function getPattern($pattern);
	public function getInputPattern($pattern);
	protected function getTokens($pattern);
	protected function getUnixDate($date);
	protected function getYear($date, $pattern = 'yyyy');
	protected function getMon($date, $pattern = 'M');
	protected function getWday($date, $pattern = 'EEEE');
	protected function getMday($date, $pattern = 'd');
	protected function getEra($date, $pattern = 'G');
	protected function getHours($date, $pattern = 'H');
	protected function getAMPM($date, $pattern = 'a');
	protected function getHour12($date, $pattern = 'h');
	protected function getMinutes($date, $pattern = 'm');
	protected function getSeconds($date, $pattern = 's');
	protected function getTimeZone($date, $pattern = 'z');
	protected function getYday($date, $pattern = 'D');
	protected function getDayInMonth($date, $pattern = 'FF');
	protected function getWeekInYear($date, $pattern = 'w');
	protected function getWeekInMonth($date, $pattern = 'W');
	protected function getHourInDay($date, $pattern = 'k');
	protected function getHourInAMPM($date, $pattern = 'K');
}
