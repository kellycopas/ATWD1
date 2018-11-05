<?php

// worked on this code with Nikki Pantony & Arron Taylor-Peter

$data = $_SERVER['DOCUMENT_ROOT'] . '/assignment/data/'; //need to change to cems server

$currXML = 'currencies.xml';

$ratesXML = 'rates.xml';

$docs = $_SERVER['DOCUMENT_ROOT'] . '/assignment/docs/'; //need to change to cems server

$functionsPHP = 'functions.php';

include ($docs.$functionsPHP);


// creates and updates rates.xml if older than 12 hours

if (file_exists($data.$ratesXML)) {
	if (filemtime($data.$ratesXML) < (time() - (0 * 12 * 0 * 0))) {
		unlink($data.$currXML);
		unlink($data.$ratesXML);
	}

	if (file_exists($data.$ratesXML)) {

	} else {
		writeCurrenciesXML();
		writeRatesXML();
	}
} else {
	writeCurrenciesXML();
	writeRatesXML();
}

$xmldoc = simplexml_load_file($data.$ratesXML);

?>