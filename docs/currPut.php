<?php

// sources: https://stackoverflow.com/questions/6522496/adding-data-to-xml-using-php 


// stores data path
$data = '/nas/students/k/kj2-copas/unix/public_html/atwd1/assignment/data/';

$ratesXML = 'rates.xml';

include ($data.$ratesXML);

//$xmldoc = simplexml_load_file($ratesXML) or die("Error: Cannot create object");
$xmldoc = new DOMDocument();
$xmldoc->load($ratesXML);

$code = $_POST['code'];
$name = $_POST['cname'];
$rate = $_POST['rate'];
$country = $_POST['cntry'];

$root = $xmldoc->firstChild;
$ccode = $xmldoc->createElement('code');
$root->appendChild($ccode);
$newText = $xmldoc->createTextNode($code);
$ccode->appendChild($newText);

$xmldoc->save($ratesXML);


/*$code = $_REQUEST["code"];
$name = $_REQUEST["cname"];
$rate = $_REQUEST["rate"];
$country = $_REQUEST["cntry"];
echo "The input is: " . $code, $name, $rate, $country . "\n";*/


	
	// save as XML format
	//$ratesXML = saveXML();
	
?>

