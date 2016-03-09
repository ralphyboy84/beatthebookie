<?php

require_once("fixtures.class.php");
require_once("dateFormat.class.php");

class fixturesTable extends fixtures
{
	public function getFixturesTable()
	{
		$fixtures = new fixtures();
		$info = $fixtures->getFixtures();
		
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
				
				$rowClass = "noPredictorRow hideRow";
				
				if ($pointsPrediction != "TOO CLOSE TO CALL") {
					$class = "highlightCell";
					$rowClass = "predictorRow showRow";
				} else {
					$class = '';
				}
				
				if (strstr($goalsPrediction, "GOAL RUSH")) {
					$classGoal = "highlightCell";
					$rowClass = "predictorRow showRow";
				} else {
					$classGoal = '';
				}
			
				$row[]=<<<EOROW
				<div class='row well $rowClass previewCell' data-fixtureid='$fixtureid'>
                    <div class="col-lg-2 col-xs-12">$date</div>
                    <div class="col-lg-3 col-xs-12">$league</div>
                    <div class="col-lg-3 col-xs-12">$homeTeam vs $awayTeam</div>
                    <div class="col-lg-2 col-xs-12 $class">$pointsPrediction</div>
                    <div class="col-lg-2 col-xs-12 $classGoal">$goalsPrediction</div>
				</div>
EOROW;
				
			}
		}
		
		if ($row) {
			return implode($row);
		}
	}
}

?>