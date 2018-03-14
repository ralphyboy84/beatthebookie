<?php

require_once 'mysqlExecutor.class.php';

class resultsDB extends mysqlExecutor
{
	function insertResult($args, $season)
	{	
		$sql = " INSERT into results$season set ";
		
		if ( $args ) {
			foreach ( $args as $key => $vals ) {
				$params[] = " `$key` = '".trim(mysqli_real_escape_string($this->db_connect(), $vals))."' ";
			}
		}
		
		$sql.= implode ( "," , $params  );
		
		return $this->insertQuery($sql);
	}
	
	public function getTeamResultsAll($args)
	{
		global $GAMELIMITER;
        global $YEAR;
        global $STARTINGPOINT;
		
		$team = $args['team'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM results$YEAR
		WHERE ( hometeam = '$team' 
		OR awayteam = '$team' )
		ORDER BY date DESC
		LIMIT $STARTINGPOINT,$GAMELIMITER
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function getTeamResultsHome($args)
	{
		global $GAMELIMITER;
        global $YEAR;
        global $STARTINGPOINT;
		
		$team = $args['team'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM results$YEAR
		WHERE hometeam = '$team'
		ORDER BY date DESC
		LIMIT $STARTINGPOINT,$GAMELIMITER
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function getTeamResultsAway($args)
	{
		global $GAMELIMITER;
        global $YEAR;
        global $STARTINGPOINT;
	
		$team = $args['team'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM results$YEAR
		WHERE awayteam = '$team'
		ORDER BY date DESC
		LIMIT $STARTINGPOINT,$GAMELIMITER
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function truncateTable()
	{
        global $YEAR;
        
		$sql=<<<EOSQL
		TRUNCATE table results$YEAR
EOSQL;
		return $this->deleteQuery($sql);
	}
	
    public function returnResultByTeamAndDate($args)
    {
        global $YEAR;
        
        $date = $args['date'];
        $h = $args['hometeam'];
        $a = $args['awayteam'];
        
        $sql=<<<EOSQL
        SELECT *
        FROM results$YEAR
        WHERE date = '$date'
        AND hometeam = '$h'
        AND awayteam = '$a'
EOSQL;
        return $this->prepareQuery($sql);   
    }
    
    public function getAllResults()
    {
        global $YEAR;
        
        $sql = "SELECT * FROM results$YEAR";
        
        return $this->prepareQuery($sql);
	}
	
	public function leagueAverages()
	{
		$sql = "
SELECT league, games, hgoals, agoals, havg, aavg, hgoals+agoals as tgoals, havg+aavg as tavg FROM
(SELECT league, 
count(*) as games, 
SUM(homescore) as hgoals, 
SUM(awayscore) as agoals,
AVG(homescore) as havg,
AVG(awayscore) as aavg
FROM results1718 
GROUP BY league)
x
ORDER BY tavg DESC
		";

		return $this->prepareQuery($sql);
	}

	public function hometeamAverages($args = false)
	{
		if ($args['limit']) {
			$limitSql = "LIMIT 0, ".$args['limit'];
		}

		$sql = "
SELECT league, hometeam, games, hgoals, agoals, havg, aavg, hgoals+agoals as tgoals, havg+aavg as tavg FROM
(SELECT league,
hometeam, 
count(*) as games, 
SUM(homescore) as hgoals, 
SUM(awayscore) as agoals,
AVG(homescore) as havg,
AVG(awayscore) as aavg
FROM results1718 
GROUP BY hometeam)
x
ORDER BY havg DESC
$limitSql
		";

		return $this->prepareQuery($sql);
	}

	public function awayteamAverages($args = false)
	{
		if ($args['limit']) {
			$limitSql = "LIMIT 0, ".$args['limit'];
		}

		$sql = "
SELECT league, awayteam, games, hgoals, agoals, havg, aavg, hgoals+agoals as tgoals, havg+aavg as tavg FROM
(SELECT league,
awayteam, 
count(*) as games, 
SUM(homescore) as hgoals, 
SUM(awayscore) as agoals,
AVG(homescore) as havg,
AVG(awayscore) as aavg
FROM results1718 
GROUP BY awayteam)
x
ORDER BY aavg DESC
$limitSql
		";

		return $this->prepareQuery($sql);
	}
}

?>