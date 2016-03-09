<?php

require_once("config.php");
require_once("predictionsDB.class.php");
require_once("resultsDB.class.php");

$pdb = new predictionsDB();
$res = $pdb->getAllPredictions();

echo "<pre>";

if ($res['res']) {
    foreach ($res['res'] as $vals) {
        $rdb = new resultsDB();
        $actualResult = $rdb->returnResultByTeamAndDate($vals);
        
        if ($actualResult['res']) {
            $acres = $actualResult['res'][0];
            
            $outcomecorrect = 0;
            $goalrushcorrect = 0;
            
            if ($vals['outcome'] == "HOME WIN") {
                if ($acres['homescore'] > $acres['awayscore']) {
                    $outcomecorrect = 1;   
                } else {
                    $outcomecorrect = 0;   
                }
            } else if ($vals['outcome'] == "AWAY WIN") {
                if ($acres['awayscore'] > $acres['homescore']) {
                    $outcomecorrect = 1;   
                } else {
                    $outcomecorrect = 0;   
                }
            }
            
            if ($vals['goalrush']) {
                if ($acres['awayscore'] > 0 && $acres['homescore'] > 0) {
                    $goalrushcorrect = 1;   
                } else {
                    $goalrushcorrect = 0;   
                }
            }
            
            $args = array (
                'hometeam' => $vals['hometeam'],
                'awayteam' => $vals['awayteam'],
                'date' => $vals['date'],
                'complete' => 1,
                'outcomecorrect' => $outcomecorrect,
                'goalrushcorrect' => $goalrushcorrect
            );
            
            $pdb->updatePrediction($args);
        }
    }
}
?>