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
}

?>