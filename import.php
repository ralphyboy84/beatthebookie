<?php

require_once("config.php");
require_once("importResults.class.php");
require_once("resultsDB.class.php");

$db = new resultsDB();
$db->truncateTable();

$seasonArray = array(
	$YEAR
);

$countries = array (
	"ENGLAND",
	"SCOTLAND",
	"GERMANY",
	"ITALY",
	"SPAIN",
	"HOLLAND", 
	"BELGIUM",
	"TURKEY",
	"GREECE",
	"PORTUGAL",
    "FRANCE"
);

foreach ($seasonArray as $season) {
	foreach ($countries as $country) {
		if ($pageArray[$country]) {
			foreach ($pageArray[$country] as $league) {
				$importResults = new importResults();
				$importResults->setSeason($season);
				$importResults->setLink($importResults::MAINURL.$importResults::RESULTURL."/".$importResults->getSeason()."/".$league.".csv");
				$importResults->testFunc();
			}
		}
	}
}

echo "DONE!";

?>