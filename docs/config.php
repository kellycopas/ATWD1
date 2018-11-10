<?php
@date_default_timezone_set("GMT"); 

// ISO currency list & API used for currency rates
define ('CURRENCY_LIST', 'https://www.currency-iso.org/dam/downloads/lists/list_one.xml'); 
define('RATES_URL', 'http://data.fixer.io/api/latest?access_key=4baab1518c2d673c07ef2b97cb81a0bd');

// make the currency array
$xml = simplexml_load_file('rates.xml');

$rates = $xml->xpath("//code");

foreach ($rates as $key=>$val) {$codes[] =(string) $val;}

// parameters in URL and format values expected
$params = array('from', 'to', 'amnt', 'format');
$formats = array('xml', 'json');

// create the variable error_hash to hold error numbers and messages
$error_hash = array (
	1000 => 'Currency type not recognised'
	1100 => 'Required parameter is missing',
	1200 => 'Parameter not recognised',
	1300 => 'Currency amount must be a decimal number',
	1400 => 'Error in service',
	2000 => 'Method not recognised or is missing',
	2100 => 'Rate in wrong format or is missing',
	2200 => 'Currency code in wrong format or is missing',
	2300 => 'Country name in wrong format or is missing',
	2400 => 'Currency code not found for update',
	2500 => 'Error in service'
);

?>