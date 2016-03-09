<?php

require_once("config.php");
require_once("fixturesPredictionsDB.class.php");

$fpdb = new fixturesPredictionsDB();
$fpdb->getFixturesPredictions();

?>