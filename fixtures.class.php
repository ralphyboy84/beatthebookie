<?php

require_once("fixturesDB.class.php");
require_once("generateTeamScore.class.php");

class fixtures
{
	protected function getFixtures()
	{	
		$db = new fixturesDB();
		$res = $db->returnFixtures();
		
		if ($res['res']) {
			$x=0;
			foreach ($res['res'] as $vals) {
				$homeTeamScore = new generateTeamScore();
				$homeTeamScore->setNumberOfGames($_POST['numberOfGames']);
				$homeTeamScore->setTeam($vals['hometeam']);
				$hts = $homeTeamScore->getTeamScore();
				
				$awayTeamScore = new generateTeamScore();
				$awayTeamScore->setNumberOfGames($_POST['numberOfGames']);
				$awayTeamScore->setTeam($vals['awayteam']);
				$ats = $awayTeamScore->getTeamScore();
				
				$res['res'][$x]['pointsPrediction'] = $this->generatePointsPrediction($hts, $ats);
				$res['res'][$x]['goalsPrediction'] = $this->generateGoalsPrediction($hts, $ats);
				$res['res'][$x]['league'] = $this->getLeagueName($vals);
				
				$x++;
			}
		}

		return $res['res'];
	}
	
	private function generatePointsPrediction($h, $a)
	{
		$homeWinSeperator = 8;
		$awayWinSeperator = 8;
	
		if (((($h['totalPoints'] + $h['homePoints'])/2) - (($a['totalPoints']+$a['awayPoints'])/2)) > $homeWinSeperator) {
			return "HOME WIN";
		} else if (((($a['totalPoints']+$a['awayPoints'])/2) - (($h['totalPoints'] + $h['homePoints'])/2)) > $awayWinSeperator) {
			return "AWAY WIN";
		} else if (($h['homePoints'] - $a['awayPoints']) > $homeWinSeperator) {
			return "HOME WIN";
		} else if (($a['awayPoints'] - $h['homePoints']) > $awayWinSeperator) {
			return "AWAY WIN";
		} else { 
			return "TOO CLOSE TO CALL";
		}
	}
	
	private function generateGoalsPrediction($h, $a)
	{
		$goalsScoredSeperator = 1;
		$goalsConceededSeperator = 1;
		
		global $GAMELIMITER;
	
		if ($h['totalGoalsScored'] > 9 && $a['totalGoalsScored'] > 11) {
			return "GOAL RUSH - BOTH TEAMS SCORING LOTS";
		} else if ($h['totalGoalsConceeded'] > 9 && $a['totalGoalsConceeded'] > 9) {
			return "GOAL RUSH - BOTH TEAMS CONCEEDING LOTS";
		} else if (	$h['totalGoalsScored'] > 5 && 
					$a['totalGoalsScored'] > 7 && 
					$h['totalGoalsConceeded'] > 7 && 
					$a['totalGoalsConceeded'] > 5) {
			return "GOAL RUSH - BOTH TEAMS SCORING AND CONCEEDING LOTS - BIG ONE!!!";
		} else if ($h['homeGoalsScored'] > 9 && $a['awayGoalsScored'] > 11) {
			return "GOAL RUSH HOME TEAM SCORING LOTS AT HOME AND AWAY TEAM SCORING LOTS AWAY";
		} else if ($h['homeGoalsConceeded'] > 11 && $a['awayGoalsConceeded'] > 9) {
			return "GOAL RUSH HOME TEAM CONCEEDING LOTS AT HOME AND AWAY TEAM CONCEEDING LOTS AWAY";
		}  if ((($h['totalGoalsScored'] + $a['totalGoalsScored'] + $h['totalGoalsConceeded'] + $a['totalGoalsConceeded']) / $GAMELIMITER) > 7) {
			return "GOAL RUSH - OVER 2.5 GOALS!";
		}else {
			return "TOO CLOSE TO CALL FOR GR";
		}
	}
	
	private function getLeagueName($args)
	{
		$array = array (
			'D1' => 'BUNDESLIGA',
			'D2' => '2ND BUNDESLIGA',
			'E0' => 'PREMIER LEAGUE',
			'E1' => 'CHAMPIONSHIP',
			'E2' => 'LEAGUE 1',
			'E3' => 'LEAGUE 2',
			'EC' => 'CONFERENCE',
			'SC0' => 'SPL',
			'SC1' => 'SCOTTISH CHAMPIONSHIP',
			'SC2' => 'SCOTTISH LEAGUE ONE',
			'SC3' => 'SCOTTISH LEAGUE TWO',
			'N1' => 'DUTCH EREDIVISE',
			'B1' => 'BELGIAN JUPILER LEAGUE',
			'I1' => 'SERIE A',
			'I2' => 'SERIE B',
			'SP1' => 'LA LIGA',
			'SP2' => 'LA SEGUNDA',
			'F1' => 'LIGUE 1',
			'F2' => 'LIGUE 2',
			'T1' => 'TURKEY',
			'G1' => 'GREECE',
			'P1' => 'PORTUGAL'
		);
		
		return $array[$args['league']];
	}
}

?>