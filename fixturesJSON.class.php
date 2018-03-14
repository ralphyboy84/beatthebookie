<?php

require_once("fixtures.class.php");
require_once("dateFormat.class.php");

class fixturesJSON extends fixtures
{
	public function getFixturesJSON()
	{
        $info = $this->getFixtures();

        $x = 0;
		
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
			
                $code = $vals['leaguecode'];
                $pointsdiff = $vals['pointsdiff'];
                $goals = $vals['goals'];
                
                if ($_GET['mode'] == "gr") {
                    $akey = str_replace(".", "", $vals['goals'])."a".$x;
                } else {
                    $akey = $vals['pointsdiff']."a".$x;
                }
                
                $row[$akey] = array (
                    'fixtureid' => $fixtureid,
                    'date' => $date,
                    'league' => $league,
                    'hometeam' => $homeTeam,
                    'awayteam' => $awayTeam,
                    'pointsdiff' => $pointsdiff,
                    'goals' => $goals
                );

                $x++;
			}    
		}
		
		if ($row) {
            krsort($row);
			return $row;
		}
	}
}

?>