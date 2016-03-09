<?php

require_once("resultsDB.class.php");

class generateTeamScore
{
	private $team;
	private $totalPoints;
	private $homePoints;
	private $awayPoints;
	private $totalScored;
	private $totalConceeded;
	private $homeScored;
	private $homeConceeded;
	private $awayScored;
	private $awayConceeded;	
	private $numberOfGames;
	
	public function getNumberOfGames()
	{
		return $this->getNumberOfGames;
	}
	
	public function setNumberOfGames($vals)
	{
		$this->numberOfGames = $val;
	}
	
	public function getTeam()
	{
		return $this->team;
	}
	
	public function setTeam($val)
	{
		$this->team = $val;
	}
	
	public function getTotalPoints()
	{
		return $this->totalPoints;
	}
	
	public function setTotalPoints($val)
	{
		$this->totalPoints = $val;
	}
	
	public function getHomePoints()
	{
		return $this->homePoints;
	}
	
	public function setHomePoints($val)
	{
		$this->homePoints = $val;
	}
	
	public function getAwayPoints()
	{
		return $this->awayPoints;
	}
	
	public function setAwayPoints($val)
	{
		$this->awayPoints = $val;
	}
	
	public function getTotalScored()
	{
		return $this->totalScored;
	}
	
	public function setTotalScored($val)
	{
		$this->totalScored = $val;
	}
	
	public function getTotalConceeded()
	{
		return $this->totalConceeded;
	}
	
	public function setTotalConceeded($val)
	{
		$this->totalConceeded = $val;
	}
	
	public function getHomeScored()
	{
		return $this->homeScored;
	}
	
	public function setHomeScored($val)
	{
		$this->homeScored = $val;
	}
	
	public function getHomeConceeded()
	{
		return $this->homeConceeded;
	}
	
	public function setHomeConceeded($val)
	{
		$this->homeConceeded = $val;
	}
	
	public function getAwayScored()
	{
		return $this->awayScored;
	}
	
	public function setAwayScored($val)
	{
		$this->awayScored = $val;
	}
	
	public function getAwayConceeded()
	{
		return $this->awayConceeded;
	}
	
	public function setAwayConceeded($val)
	{
		$this->awayConceeded = $val;
	}
	
	public function getTeamScore()
	{
		$args = array (
			'team' => $this->getTeam(),
			'limit' => $this->getNumberOfGames(),
		);
		
		$db = new resultsDB();
		$res = $db->getTeamResultsAll($args);
		
		if ($res['res']) {
			foreach ($res['res'] as $vals) {
				$this->calculateScore($vals, "total");
				$this->calculateGoals($vals, "total");
			}
		}
		
		$db = new resultsDB();
		$res = $db->getTeamResultsHome($args);
		
		if ($res['res']) {
			foreach ($res['res'] as $vals) {
				$this->calculateScore($vals, "home");
				$this->calculateGoals($vals, "home");
			}
		}
		
		$db = new resultsDB();
		$res = $db->getTeamResultsAway($args);
		
		if ($res['res']) {
			foreach ($res['res'] as $vals) {
				$this->calculateScore($vals, "away");
				$this->calculateGoals($vals, "away");
			}
		}
		
		return array (
			'totalPoints' => $this->getTotalPoints(),
			'homePoints' => $this->getHomePoints(),
			'awayPoints' => $this->getAwayPoints(),
			'totalGoalsScored' => $this->getTotalScored(),
			'totalGoalsConceeded' => $this->getTotalConceeded(),
			'homeGoalsScored' => $this->getHomeScored(),
			'homeGoalsConceeded' => $this->getHomeConceeded(),
			'awayGoalsScored' => $this->getAwayScored(),
			'awayGoalsConceeded' => $this->getAwayConceeded(),
		);
	}
	
	private function calculateScore($args, $mode)
	{
		if ($args['hometeam'] == $this->getTeam()) {
			if ($args['homescore'] > $args['awayscore']) {
				$points = 3;
			} else if ($args['homescore'] == $args['awayscore']) {
				$points = 1;
			}
		} else if ($args['awayteam'] == $this->getTeam()) {
			if ($args['homescore'] < $args['awayscore']) {
				$points = 3;
			} else if ($args['homescore'] == $args['awayscore']) {
				$points = 1;
			}
		}

		if ($mode == "total") {
			$points = $points + $this->getTotalPoints();
			$this->setTotalPoints($points);
		} else if ($mode == "home") {
			$points = $points + $this->getHomePoints();
			$this->setHomePoints($points);
		} else if ($mode == "away") {
			$points = $points + $this->getAwayPoints();
			$this->setAwayPoints($points);
		}
	}
	
	private function calculateGoals($args, $mode)
	{
		if ($args['hometeam'] == $this->getTeam()) {
			$scored = $args['homescore'];
			$conceeded = $args['awayscore'];
		} else if ($args['awayteam'] == $this->getTeam()) {
			$scored = $args['awayscore'];
			$conceeded = $args['homescore'];
		}
		
		if ($mode == "total") {
			$scored = $scored + $this->getTotalScored();
			$this->setTotalScored($scored);
			
			$conceeded = $conceeded + $this->getTotalConceeded();
			$this->setTotalConceeded($conceeded);
		} else if ($mode == "home") {
			$scored = $scored + $this->getHomeScored();
			$this->setHomeScored($scored);
			
			$conceeded = $conceeded + $this->getHomeConceeded();
			$this->setHomeConceeded($conceeded);
		} else if ($mode == "away") {
			$scored = $scored + $this->getAwayScored();
			$this->setAwayScored($scored);
			
			$conceeded = $conceeded + $this->getAwayConceeded();
			$this->setAwayConceeded($conceeded);
		}
	}
}

?>