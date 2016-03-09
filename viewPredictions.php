<?php

require_once("config.php");
require_once("predictionsDB.class.php");
require_once("resultsDB.class.php");

$pdb = new predictionsDB();
$res = $pdb->getCompletePredictions();

$homewin = 0;
$homeloss = 0;
$awaywin = 0;
$awayloss = 0;
$grwin;
$grloss;

if ($res['res']) {
    foreach ($res['res'] as $vals) {
        if ($vals['outcome'] == "HOME WIN" && $vals['outcomecorrect']) {
            $homewin++;
        } else if ($vals['outcome'] == "HOME WIN") {
            $homeloss++;   
        }
        
        if ($vals['outcome'] == "AWAY WIN" && $vals['outcomecorrect']) {
            $awaywin++;
        } else if ($vals['outcome'] == "AWAY WIN") {
            $awayloss++;   
        }
        
        if ($vals['goalrush'] && $vals['goalrushcorrect']) {
            $grwin++;
        } else if ($vals['goalrush']) {
            $grloss++;
        }
    }
}

echo "Home success: ". round((($homewin/($homeloss+$homewin)) * 100),2)."%<br />";
echo "Away success: ". round((($awaywin/($awayloss+$awaywin)) * 100),2)."%<br />";
echo "GR success: ". round((($grwin/($grloss+$grwin)) * 100),2)."%<br />";
echo "Total Success: ". round(((($grwin+$homewin+$awaywin)/($homeloss+$homewin+$awayloss+$awaywin+$grloss+$grwin))*100),2)."%";
?>