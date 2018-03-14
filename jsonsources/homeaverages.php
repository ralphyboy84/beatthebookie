<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once ("../config.php");
require_once ("../resultsDB.class.php");

$dbargs['limit'] = 50;
$db = new resultsDB();
$table = $db->hometeamAverages($dbargs);

if ($table['res']) {
    foreach ($table['res'] as $res) {
        $args[$res['hometeam']]['games'] = $res['games'];
        $args[$res['hometeam']]['total'] = $res['tgoals'];
        $args[$res['hometeam']]['home'] = $res['hgoals'];
        $args[$res['hometeam']]['away'] = $res['agoals'];
        $args[$res['hometeam']]['totalavg'] = $res['tavg'];
        $args[$res['hometeam']]['havg'] = $res['havg'];
        $args[$res['hometeam']]['aavg'] = $res['aavg'];
    }
}

echo json_encode($args);

?>