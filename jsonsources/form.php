<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once("../config.php");
require_once("../fixturesInfo.class.php");

$fi = new fixturesInfo();
$fi->setFixtureId($_GET['fixtureid']);
$info = $fi->getFixtureInfo();

require_once("../teamHistoryJSON.class.php");

$homeTeam = new teamHistoryJSON();
$homeTeam->setTeam($info['hometeam']);

$awayTeam = new teamHistoryJSON();
$awayTeam->setTeam($info['awayteam']);

if ($_GET['dataset'] == "homehome") {
    $args = $homeTeam->getHomeHistoryJSON();
} else if ($_GET['dataset'] == "hometotal") {
    $args = $homeTeam->getTotalHistoryJSON();
} else if ($_GET['dataset'] == "awayaway") {
    $args = $awayTeam->getAwayHistoryJSON();
} else if ($_GET['dataset'] == "awaytotal") {
    $args = $awayTeam->getTotalHistoryJSON();
}

echo json_encode($args);

?>