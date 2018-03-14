<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once ("../config.php");
require_once ("../resultsDB.class.php");

$dbargs['limit'] = 50;
$db = new resultsDB();
$table = $db->awayteamAverages($dbargs);

if ($table['res']) {
    foreach ($table['res'] as $res) {
        $args[$res['awayteam']]['games'] = $res['games'];
        $args[$res['awayteam']]['total'] = $res['tgoals'];
        $args[$res['awayteam']]['home'] = $res['hgoals'];
        $args[$res['awayteam']]['away'] = $res['agoals'];
        $args[$res['awayteam']]['totalavg'] = $res['tavg'];
        $args[$res['awayteam']]['havg'] = $res['havg'];
        $args[$res['awayteam']]['aavg'] = $res['aavg'];
    }
}

echo json_encode($args);

?>