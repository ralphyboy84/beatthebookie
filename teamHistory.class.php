<?php

require_once("resultsDB.class.php");

class teamHistory
{
	public $team;
	public $opposition;
	
	public function setTeam($val)
	{
		$this->team = $val;
	}
	
	public function getTeam()
	{
		return $this->team;
	}
	
	protected function getHomeHistory()
	{
		$args = array (
			'team' => $this->getTeam(),
		);
	
		$db = new resultsDB();
		$home = $db->getTeamResultsHome($args);
		
		return $home['res'];		
	}
	
	protected function getAwayHistory()
	{
		$args = array (
			'team' => $this->getTeam(),
		);
	
		$db = new resultsDB();
		$home = $db->getTeamResultsAway($args);
		
		return $home['res'];		
	}
	
	protected function getTotalHistory()
	{
		$args = array (
			'team' => $this->getTeam(),
		);
	
		$db = new resultsDB();
		$home = $db->getTeamResultsAll($args);
		
		return $home['res'];		
	}

}

?>