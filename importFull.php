<?php

require_once("config.php");
require_once("importResults.class.php");

$seasonArray = array(
	1011,1112,1213,1314,1415,1516
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
	"PORTUGAL"
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