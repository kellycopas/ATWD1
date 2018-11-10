<?php

// sources: https://www.w3schools.com/php/php_xml_simplexml_get.asp 
// https://stackoverflow.com/questions/28866314/php-remove-children-with-a-specific-attribute-in-php 
// https://stackoverflow.com/questions/20471448/how-to-save-the-data-that-the-user-input-in-form-page-after-the-script-executed 

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

