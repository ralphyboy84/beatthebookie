<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once ("../config.php");
require_once ("../fixturesJSON.class.php");

$fixtureList = new fixturesJSON();
$table = $fixtureList->getFixturesJSON();
echo json_encode($table);

?>