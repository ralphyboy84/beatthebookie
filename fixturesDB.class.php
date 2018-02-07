<?php

require_once 'mysqlExecutor.class.php';

class fixturesDB extends mysqlExecutor
{
	public function insertFixture($args)
	{	
		$sql = " INSERT into fixtures set ";
		
		if ( $args ) {
			foreach ( $args as $key => $vals ) {
				$params[] = " `$key` = '".trim(mysqli_real_escape_string($this->db_connect(), $vals))."' ";
			}
		}
		
		$sql.= implode ( "," , $params  );
		
		return $this->insertQuery($sql);
	}
	
	public function returnFixtures()
	{
		$date = date("Y-m-d");
	
		$sql=<<<EOSQL
		SELECT *
		FROM fixtures
		WHERE date >= '$date'
		ORDER BY `date` ASC
EOSQL;
		return $this->prepareQuery($sql);
	}
	
	public function truncateDB()
	{
		$sql=<<<EOSQL
		TRUNCATE table fixtures
EOSQL;
		return $this->deleteQuery($sql);
	}
	
	public function returnAFixture($args)
	{
		$fixtureid = $args['fixtureid'];
		
		$sql=<<<EOSQL
		SELECT *
		FROM fixtures
		WHERE fixtureid = '$fixtureid'
EOSQL;
		return $this->prepareQuery($sql);
	}
}

?>