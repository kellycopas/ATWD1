<?php

@date_default_timezone_set("GMT");

// function to generate errors
require_once('generate_error.php');

// exit if core data files are missing
if(!file_exists('rates.xml') || !file_exists('currencies.xml')) {
	echo generate_error(1400, $error_hash, 'xml');
	exit;
}

// make the currency array
$xml = simplexml_load_file('rates.xml');
$rates = $xml->xpath("//code");
foreach ($rates as $key=>$val) {
	$codes[] = (string) $val;
}

// parameters in URL and format values expected
$params = array('from', 'to', 'amnt', 'format');
$formats = array('xml', 'json');

// turn $_GET parameters into PHP variables
extract($_GET);

// set format to default to XML
if(!isset($format) || empty($format)) {
	$format = 'xml';
}

$get = array_intersect($params, array_keys($_GET));

if(count($get) < 4) {
	echo generate_error(1100, $error_hash, $format);
	exit;
}

if(count($GET) > 4) {
	echo generate_error(1200, $error_hash, $format);
	exit;
}

// $to and $from are not recognised currencies
if(!in_array($to, $codes) || !in_array($from, $codes)) {
	echo generate_error(1000, $error_hash, $format);
	exit;
}

// check for allowed format values
if(!in_array($format, $formats)) {
	echo generate_error(1200, $error_hash, $format);
	exit;
}

// $amnt is not a decimal value
if(!preg_match('/^[+-]?(\d*\.\d+([eE]?[+-]?\d+)?|\d+[eE][+-]?\d+)$/', $amnt)) {
	echo generate_error(1300, $error_hash, $format);
	exit;
}

echo "All validation passed :)";





