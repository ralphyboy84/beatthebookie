<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once ("../config.php");
require_once ("../resultsDB.class.php");

$db = new resultsDB();
$table = $db->leagueAverages();

if ($table['res']) {
    foreach ($table['res'] as $res) {
        $args[$res['league']]['league'] = $res['league'];
        $args[$res['league']]['games'] = $res['games'];
        $args[$res['league']]['total'] = $res['tgoals'];
        $args[$res['league']]['home'] = $res['hgoals'];
        $args[$res['league']]['away'] = $res['agoals'];
        $args[$res['league']]['totalavg'] = $res['tavg'];
        $args[$res['league']]['havg'] = $res['havg'];
        $args[$res['league']]['aavg'] = $res['aavg'];
    }
}

echo json_encode($args);

?>