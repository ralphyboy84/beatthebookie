<?php

require_once 'mysqlExecutor.class.php';

class predictionsDB extends mysqlExecutor
{
	public function insertPrediction($args)
	{	
		$sql = " INSERT into predictions set ";
		
		if ( $args ) {
			foreach ( $args as $key => $vals ) {
				$params[] = " `$key` = '".trim(mysql_real_escape_string($vals))."' ";
			}
		}
		
		$sql.= implode ( "," , $params  );
		
		return $this->insertQuery($sql);
	}
    
    public function checkPredictionExists($args)
    {
        $date = $args['date'];
        $h = $args['hometeam'];
        $a = $args['awayteam'];
        
        $sql=<<<EOSQL
        SELECT *
        FROM predictions
        WHERE date = '$date'
        AND hometeam = '$h'
        AND awayteam = '$a'
EOSQL;
        return $this->prepareQuery($sql);
    }
    
    public function getAllPredictions()
    {
        $sql=<<<EOSQL
        SELECT *
        FROM predictions
        WHERE complete = '0'
EOSQL;
        return $this->prepareQuery($sql);
    }
    
    public function getCompletePredictions()
    {
        $sql=<<<EOSQL
        SELECT *
        FROM predictions
        WHERE complete = '1'
EOSQL;
        return $this->prepareQuery($sql);
    }
    
    public function updatePrediction($args)
    {
        $sql = "UPDATE predictions SET complete = '".$args['complete']."', outcomecorrect = '".$args['outcomecorrect']."', goalrushcorrect = '".$args['goalrushcorrect']."' WHERE date = '".$args['date']."' AND hometeam = '".$args['hometeam']."' AND awayteam = '".$args['awayteam']."' ";
        
        return $this->updateQuery($sql);
    }
}

?>