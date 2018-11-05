<?php

$xml = simplexml_load_file('rates.xml');
$rates = $xml->currency[0]->code;

$xml = simplexml_load_file('rates.xml');
$xml->currency[0]->code = $_POST[''];

$handle = fopen("rates.xml", "wb");
fwrite($handle, $data->asXML());
fclose($handle);

?>