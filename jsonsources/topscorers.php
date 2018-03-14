<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once ("../config.php");
require_once ("../resultsDB.class.php");

$dbargs['limit'] = 50;
$db = new resultsDB();
$table1 = $db->hometeamAverages($dbargs);

if ($table1['res']) {
    foreach ($table1['res'] as $res) {
        $args[$res['hometeam']."#h"]['games'] = $res['games'];
        $args[$res['hometeam']."#h"]['total'] = $res['tgoals'];
        $args[$res['hometeam']."#h"]['home'] = $res['hgoals'];
        $args[$res['hometeam']."#h"]['away'] = $res['agoals'];
        $args[$res['hometeam']."#h"]['totalavg'] = $res['tavg'];
        $args[$res['hometeam']."#h"]['havg'] = $res['havg'];
        $args[$res['hometeam']."#h"]['aavg'] = $res['aavg'];
    }
}

$dbargs['limit'] = 50;
$db = new resultsDB();
$table2 = $db->awayteamAverages($dbargs);

if ($table2['res']) {
    foreach ($table2['res'] as $res) {
        $args[$res['awayteam']."#a"]['games'] = $res['games'];
        $args[$res['awayteam']."#a"]['total'] = $res['tgoals'];
        $args[$res['awayteam']."#a"]['home'] = $res['hgoals'];
        $args[$res['awayteam']."#a"]['away'] = $res['agoals'];
        $args[$res['awayteam']."#a"]['totalavg'] = $res['tavg'];
        $args[$res['awayteam']."#a"]['havg'] = $res['havg'];
        $args[$res['awayteam']."#a"]['aavg'] = $res['aavg'];
    }
}

require_once ("../fixturesJSON.class.php");

$fixtureList = new fixturesJSON();
$table = $fixtureList->getFixturesJSON();

if ($table) {
    $x = 0;

    foreach ($table as $row) {
        if (array_key_exists($row['hometeam']."#h", $args) && array_key_exists($row['awayteam']."#a", $args)) {
            $json[$x]['hometeam'] =  $row['hometeam'];
            $json[$x]['hometotalavg'] = $args[$row['hometeam']."#h"]['totalavg'];
            $json[$x]['homeavg'] = $args[$row['hometeam']."#h"]['havg'];
            $json[$x]['awayteam'] = $row['awayteam'];
            $json[$x]['awaytotalavg'] = $args[$row['awayteam']."#a"]['totalavg'];
            $json[$x]['awayavg'] = $args[$row['awayteam']."#a"]['aavg'];
            $x++;
        }
    }
}

print_r($json);

?>