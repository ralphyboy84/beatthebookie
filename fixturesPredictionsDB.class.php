<?php

require_once("fixtures.class.php");
require_once("dateFormat.class.php");
require_once("predictionsDB.class.php");

class fixturesPredictionsDB extends fixtures
{
	public function getFixturesPredictions()
	{
		$fixtures = new fixtures();
		$info = $fixtures->getFixtures();
		
		if ($info) {
			foreach ($info as $vals) {
				if ($vals['pointsPrediction'] == "HOME WIN" || $vals['pointsPrediction'] == "AWAY WIN" || strstr($vals['goalsPrediction'], "GOAL RUSH")) {
					
					if (strstr($vals['goalsPrediction'], "GOAL RUSH")) {
						$goalRush = 1;
					} else {
						$goalRush = 0;
					}
					
					$args = array (
						'date' => $vals['date'],
						'hometeam' => $vals['hometeam'],
						'awayteam' => $vals['awayteam'],
						'outcome' => $vals['pointsPrediction'],
						'goalrush' => $goalRush,
                        'league' => $vals['league']
					);
					
                    //check it exists first....
                    $db = new predictionsDB();
					
                    $check = $db->checkPredictionExists($args);
                    
                    if (!$check['res']) {
					   $db->insertPrediction($args);
                    }
				}
			}
		}
	}
}

?>