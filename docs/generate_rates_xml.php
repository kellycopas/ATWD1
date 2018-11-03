<?php
	
@date_default_timezone_set("GMT");

// Declare the currency array
$ccodes = array('AUD','BRL','CAD','CHF','CNY','DKK','EUR','GBP','HKD','HUF','INR','JPY','MXN','MYR','NOK','NZD','PHP','RUB','SEK','SGD','THB','TRY','USD','ZAR');

// Pull the rates JSON file from currencylayer
$json_rates = file_get_contents('http://data.fixer.io/api/latest?access_key=4baab1518c2d673c07ef2b97cb81a0bd') or die("Error: Cannot load JSON file from currencylayer");

// Decode the JSON to a PHP object
$rates = json_decode($json_rates);

// Calculate the GBP ratio
$gbp_rate = 1/ $rates->rates->GBP;

// Pull the currencies XML file into a simplexml object
$xml = simplexml_load_file('currencies.xml') or die("Error: Cannot load currencies file");

// Start & initialise the writer
$writer = new XMLWriter();
$writer -> openURI('rates.xml');
$writer -> startDocument("1.0");
$writer -> startElement("currencies");
$writer -> writeAttribute('base', 'GBP');

// For every currency node in the array, select its parent & subnodes & write them out after tidying up the countries list
foreach($ccodes as $code) {
	if(isset($rates->rates->$code)) {
		$nodes = $xml->xpath("//ccode[.='$code']/parent::*");

		$writer -> startElement("currency");
			$writer -> startElement("code");
			$writer -> writeAttribute('rate', $rates->rates->$code * $gbp_rate);
			$writer -> text($code);
			$writer -> endElement();
			
			$writer -> startElement("cname");
			$writer -> text($nodes[0]->cname);
			$writer -> endElement();

			$writer -> startElement("cntry");

			// Tidy up countries node
			$cntry = trim(preg_replace('/[\t\n\r\s]+/', ' ', $nodes[0]->cntry));
			$wrong = array("Of", "And", "U.s.", "(The)", " , ");
			$right = array("of", "and", "U.S.", "", ", ");
			$cn = str_replace($wrong, $right, $cntry);

			$writer -> text($cn);
			$writer -> endElement();
		$writer -> endElement();
	}
}

$writer -> endDocument();
$writer -> flush();
echo "All done....!";

?>