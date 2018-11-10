<?php

// stores data path
$data = '/nas/students/k/kj2-copas/unix/public_html/atwd1/assignment/data/';

$ratesXML = 'rates.xml';

include ($data.$ratesXML);

$xmldoc = simplexml_load_file($ratesXML) or die("Error: Cannot create object");
//$xmldoc = simplexml_load_file($data.$ratesXML) or die("Error: Cannot create object");

$ccode = $_POST['code'];
//echo "The code is: " . $ccode . "\n";

$currencies = $xmldoc->xpath("/currencies/currency[@code='$ccode']");

foreach ($currencies as $currency) unset($currency[0]);

echo $ratesXML->asXML();
	
	// save as XML format
	//$ratesXML = saveXML();
?>

