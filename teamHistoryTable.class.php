<?php

require_once("teamHistory.class.php");

class teamHistoryTable extends teamHistory
{
	public function getHomeHistoryTable()
	{
		global $GAMELIMITER;
	
		$args = $this->getHomeHistory();
		$row = $this->formatResults($args);		
		
		if ($row) {
			return "Last $GAMELIMITER home games for: ".$this->getTeam()."<table>".implode($row)."</table>";
		}
	}
	
	public function getAwayHistoryTable()
	{
		global $GAMELIMITER;
		
		$args = $this->getAwayHistory();
		$row = $this->formatResults($args);		
		
		if ($row) {
			return "Last $GAMELIMITER away games for: ".$this->getTeam()."<table>".implode($row)."</table>";
		}
	}
	
	public function getTotalHistoryTable()
	{
		global $GAMELIMITER;
	
		$args = $this->getTotalHistory();
		$row = $this->formatResults($args);	
		
		if ($row) {
			return "Last $GAMELIMITER games for: ".$this->getTeam()."<table>".implode($row)."</table>";
		}
	}
	
	private function formatResults($args)
	{
		if ($args) {
			foreach ($args as $vals) {
				$row[] = $this->generateTableRow($vals);
			}
			$row[] = $this->generateGoals($args);
		}
		
		return $row;
	}
	
	private function generateTableRow($args)
	{
		$homeTeam = $args['hometeam'];
		$awayTeam = $args['awayteam'];
		$homeScore = $args['homescore'];
		$awayScore = $args['awayscore'];
	
		if ($homeTeam == $this->getTeam()) {
			$boldClassHome = "class='boldTeam'";
		} else if ($awayTeam == $this->getTeam()) {
			$boldClassAway = "class='boldTeam'";
		}
	
		return <<<EOROW
		<tr>
			<td $boldClassHome>$homeTeam</td>
			<td>$homeScore</td>
			<td>-</td>
			<td>$awayScore</td>
			<td $boldClassAway>$awayTeam</td>
		</tr>
EOROW;
	}
	
	private function generateGoals($args)
	{
		if ($args) {
			foreach ($args as $vals) {
				$homeTeam = $vals['hometeam'];
				$awayTeam = $vals['awayteam'];
				$homeScore = $vals['homescore'];
				$awayScore = $vals['awayscore'];
			
				if ($homeTeam == $this->getTeam()) {
					$goals = $goals + $homeScore;
					$conceeded = $conceeded + $awayScore;
				} else if ($awayTeam == $this->getTeam()) {
					$goals = $goals + $awayScore;
					$conceeded = $conceeded + $homeScore;
				}
			}
		}
		
		return "<tr><td colspan='5'>Scored: $goals - Conceeded: $conceeded</td></tr>";
	}
}

?>