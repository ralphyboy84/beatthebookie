<?php

require_once 'mysqlExecutor.class.php';

class resultsDB extends mysqlExecutor
{
	function insertResult($args, $season)
	{	
		$sql = " INSERT into results$season set ";
		
		if ( $args ) {
			foreach ( $args as $key => $vals ) {
				$params[] = " `$key` = '".trim(mysql_real_escape_string($vals))."' ";
			}
		}
		
		$sql.= implode ( "," , $params  );
		
		return $this->insertQuery($sql);
	}
	
	public function getTeamResultsAll($args)
	{
		global $GAMELIMITER;
		
		$team = $args['team'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM results1516
		WHERE ( hometeam = '$team' 
		OR awayteam = '$team' )
		ORDER BY date DESC
		LIMIT 0,$GAMELIMITER
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function getTeamResultsHome($args)
	{
		global $GAMELIMITER;
		
		$team = $args['team'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM results1516
		WHERE hometeam = '$team'
		ORDER BY date DESC
		LIMIT 0,$GAMELIMITER
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function getTeamResultsAway($args)
	{
		global $GAMELIMITER;
	
		$team = $args['team'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM results1516
		WHERE awayteam = '$team'
		ORDER BY date DESC
		LIMIT 0,$GAMELIMITER
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function truncateTable()
	{
		$sql=<<<EOSQL
		TRUNCATE table results1516
EOSQL;
		return $this->prepareQuery($sql);
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
}

?>