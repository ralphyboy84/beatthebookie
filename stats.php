<?php

require_once("config.php");
require_once("resultsDB.class.php");

$db = new resultsDB();

$res = $db->getAllResults();

if ($res) {
    foreach ($res['res'] as $vals) {
        if ($vals['homescore'] > 0 && $vals['awayscore'] > 0) {
            $count = $league[$vals['league']]['gr'];
            $count = $count + 1;
            $league[$vals['league']]['gr'] = $count;
            
            $tch = $team[$vals['hometeam']]['gr'];
            $tch = $tch + 1;
            $team[$vals['hometeam']]['gr'] = $tch;
                  
            $tca = $team[$vals['awayteam']]['gr'];
            $tca = $tca + 1;
            $team[$vals['awayteam']]['gr'] = $tca;
        } else {
            $count = $league[$vals['league']]['nogr'];
            $count = $count + 1;
            $league[$vals['league']]['nogr'] = $count;
            
            $tch = $team[$vals['hometeam']]['nogr'];
            $tch = $tch + 1;
            $team[$vals['hometeam']]['nogr'] = $tch;
                  
            $tca = $team[$vals['awayteam']]['nogr'];
            $tca = $tca + 1;
            $team[$vals['awayteam']]['nogr'] = $tca;
        }
        
        $totalgoals = $vals['homescore'] + $vals['awayscore'];
        
        if ($totalgoals > 2) {
            $count = $league[$vals['league']]['o'];
            $count = $count + 1;
            $league[$vals['league']]['o'] = $count;
        } else {
            $count = $league[$vals['league']]['u'];
            $count = $count + 1;
            $league[$vals['league']]['u'] = $count;
        }
    }
}

foreach ($league as $key => $lg) {
    
    $grpct = round(($lg['gr'] / ($lg['gr'] + $lg['nogr'])) * 100, 2);
    $o25pct = round(($lg['o'] / ($lg['o'] + $lg['u'])) * 100, 2);
    
    $array[$grpct.$key."GR"] = $lookUpArray[$key]." - GOAL RUSH - $grpct%";
    $array[$o25pct.$key."O25"] = $lookUpArray[$key]." - OVER 2.5 - $o25pct%";
}

foreach ($team as $key => $lg) {
    
    $grpct = round(($lg['gr'] / ($lg['gr'] + $lg['nogr'])) * 100, 2);
    //$o25pct = round(($lg['o'] / ($lg['o'] + $lg['u'])) * 100, 2);
    
    $teamarray[$grpct.$key."GR"] =$key." - GOAL RUSH - $grpct%";
    //$array[$o25pct.$key."O25"] = $lookUpArray[$key]." - OVER 2.5 - $o25pct%";
}

krsort($array);
krsort($teamarray);

echo implode($array, "<br />");

echo "<br />#############################<br />";

echo implode($teamarray, "<br />");

?>