<?php

$code = $_POST['code'];

$xml = newDOMDocument();
$xml->load('rates.xml');

$xpath = new DOMXPath($xml);

$nodes = $xpath->query('/currencies/currency[code[text() = "' . $_POST['code'] . '"]]');

foreach ($nodes as $currencyNode) {
	if ($currencyNode->parentNode === null) {
		continue;
	}
	$currencyNode->parentNode->removeChild($currencyNode);
}

//$xml->formatOutput = true;
$xml->saveXML();

header('Location: form.html');
exit();

?>