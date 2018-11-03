<?php
	
@date_default_timezone_set("GMT");


// Pull the ISO currencies into a simplexml object
$xml = simplexml_load_file('https://www.currency-iso.org/dam/downloads/lists/list_one.xml') or die("Error: Cannot create object");

$writer = new XMLWriter();
$writer->openURI('currencies.xml');
$writer->startDocument("1.0");
$writer->startElement("currencies");

// Get all the currency codes
$codes = $xml -> xpath("//CcyNtry/Ccy");
$ccodes = [];

// Place unique currency codes in an array
foreach ($codes as $code) {
	if (!in_array($code, $ccodes)) {
		$ccodes[] = (string) $code;
	}
}

foreach ($ccodes as $ccode) {
	$nodes = $xml -> xpath("//Ccy[.='$ccode']/parent::*");

	$cname = $nodes[0] -> CcyNm;

	// Writing out the nodes and values
	$writer -> startElement("currency");
		$writer -> startElement("ccode");
		$writer -> text($ccode);
		$writer -> endElement();
		$writer -> startElement("cname");
		$writer -> text($cname);
		$writer -> endElement();
		$writer -> startElement("cntry");

			$last = count($nodes) - 1;

			// Group countries together & lower first letter in name
			foreach ($nodes as $index => $node) {
				$writer -> text(mb_convert_case($node -> CtryNm, MB_CASE_TITLE, "UTF-8"));
				if ($index != $last) {
					$writer -> text(', ');
				}
			}
		$writer -> endElement();

	$writer -> endElement();
}

// Finish document
$writer -> endDocument();
$writer -> flush();
echo "All done...!"

?>