<?php

require_once("fixtures.class.php");
require_once("dateFormat.class.php");

class fixturesTable extends fixtures
{
	public function getFixturesTable()
	{
		$fixtures = new fixtures();
		$info = $fixtures->getFixtures();
        
        $x=1;
		
		if ($info) {
			foreach ($info as $vals) {
				$dateFormat = new dateFormat();
				$dateFormat->setDate($vals['date']);
				$date = $dateFormat->mysqlToDate();
				
				$fixtureid = $vals['fixtureid'];
				$homeTeam = $vals['hometeam'];
				$awayTeam = $vals['awayteam'];
				$league = $vals['league'];
				$pointsPrediction = $vals['pointsPrediction'];
				$goalsPrediction = $vals['goalsPrediction'];
				
				//$rowClass = "noPredictorRow hideRow";
				
				if ($pointsPrediction != "TOO CLOSE TO CALL") {
					$class = "highlightCell";
					//$rowClass = "predictorRow showRow";
				} else {
					$class = '';
				}
				
				if (strstr($goalsPrediction, "GOAL RUSH")) {
					$classGoal = "highlightCell";
					//$rowClass = "predictorRow showRow";
				} else {
					$classGoal = '';
				}
			
                $code = $vals['leaguecode'];
                $pointsdiff = $vals['pointsdiff'];
                $goals = $vals['goals'];
                
                if ($_GET['mode'] == "gr") {
                    $akey = str_replace(".", "", $vals['goals'])."a".$x;
                } else {
                    $akey = $vals['pointsdiff']."a".$x;
                }
                
				$row[$akey]=<<<EOROW
				<div class='row well $rowClass showRow previewCell $code' data-fixtureid='$fixtureid'>
                    <div class="col-lg-2 col-xs-12">Game $x</div>
                    <div class="col-lg-2 col-xs-12">$date</div>
                    <div class="col-lg-2 col-xs-12">$league</div>
                    <div class="col-lg-2 col-xs-12">$homeTeam vs $awayTeam</div>
                    <div class="col-lg-2 col-xs-12">Points Difference - $pointsdiff</div>
                    <div class="col-lg-2 col-xs-12">Goals - $goals</div>
				</div>
EOROW;
                $x++;
			}    
		}
		
		if ($row) {
            krsort($row);
			return implode($row);
		}
	}
}

?>