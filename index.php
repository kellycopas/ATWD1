<?php

// worked on this code with Nikki Pantony 

// stores docs directory path
$docs = $_SERVER['DOCUMENT_ROOT'] . '/assignment/docs/';   // change this to uwe server path

// stores index.php 
$index = 'index.php';

// pulls data from rates.xml
include ($docs.$index);

if ($_GET['from']) {
	$from = $_GET['from'];
	$to = $_GET['to'];
	$amount = $_GET['amnt'];

	$from_node = $xmldoc->xpath("/currencies/currency/code[text()='{$from}']/parent::*")[0];
	$from_rate = floatval($from_node->code->attributes()["rate"]);
	$from_currency = $from_node->cname->__toString();
	$from_locations = $from_node->cntry->__toString();

	$to_node = $xmldoc->xpath("/currencies/currency/code[text()='{$to}']/parent::*")[0];
	$to_rate = floatval($to_node->code->attributes()["rate"]);
	$to_currency = $to_node->cname->__toString();
	$to_locations = $to_node->cntry->__toString();

	// forms the XML output, use of the PHP manual for addChild - http://php.net/manual/en/simplexmlelement.addchild.php
	$conv = new SimpleXMLElement('<conv/>');
	$conv -> addChild('at', date('d M Y h:i'));
	$conv -> addChild('rate', $from_rate);
	
	$fromNode = $conv->addChild('from');
	$from_code = $fromNode->addChild('code' , $from);
	$from_curr = $fromNode->addChild('curr' , $from_currency);
	$from_loc = $fromNode->addChild('loc' , $from_locations);
	$from_amnt = $fromNode->addChild('amnt' , $amount);

	$toNode = $conv->addChild('to');
	$to_code = $toNode->addChild('code' , $to);
	$to_curr = $toNode->addChild('curr' , $to_currency);
	$to_loc = $toNode->addChild('loc' , $to_locations);
	$to_amnt = $toNode->addChild('amnt' , ($amount / $from_rate) * $to_rate);

	// save as XML format
	$xml = $conv->asXML();

	// XML format
	if ($_GET['format'] === 'xml') {
		header('Content-Type: text/xml');
		echo $xml;
	}

	// JSON format
	if ($_GET['format'] === 'json') {
		$xml = simplexml_load_string($xml);
		$json = json_encode($xml);
		header ("Content-Type: application/json");
		echo $json;
	}

	// if no format is given
	if ($_GET['format'] === '') {
		header('Content-Type: text/xml');
		echo $xml;
	}

} else {
	echo 'No Inputs';
}
?>