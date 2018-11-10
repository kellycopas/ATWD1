<?php

// worked on this code with Nikki Pantony & Arron Taylor-Peter

//$data = $_SERVER['DOCUMENT_ROOT'] . '/atwd1/assignment/data/';  //localhost path
$data = '/nas/students/k/kj2-copas/unix/public_html/atwd1/assignment/data/';

$currXML = 'currencies.xml';

$ratesXML = 'rates.xml';

//$docs = $_SERVER['DOCUMENT_ROOT'] . '/atwd1/assignment/docs/';  //localhost path
$docs = '/nas/students/k/kj2-copas/unix/public_html/atwd1/assignment/docs/'; 

$functionsPHP = 'functions.php';

include ($docs.$functionsPHP);


// creates and updates rates.xml if older than 12 hours
// compare current time with last modification time of rates.xml
$stat = $data.$ratesXML; 

// time minus modified time of rates.xml, convert seconds to hours
$diff = time()-filemtime($stat);
$hours = round($diff/3600); 

	// checking if file exists
	if (!file_exists($stat)) {
	writeCurrenciesXML();
	writeRatesXML();
	}
	// re-write files if more than 12 hours old
	elseif(file_exists($stat)&&($hours > 12)) {
		unlink($data.$currXML);
		unlink($data.$ratesXML);
		writeCurrenciesXML();
		writeRatesXML();
	}
$xmldoc = simplexml_load_file($data.$ratesXML);

//testing
/*$filename = $data.$ratesXML;
	if(file_exists($filename)) {
		echo "$filename was last modified: " . date ("H:i:s.", filemtime($filename));
	}*/
?>